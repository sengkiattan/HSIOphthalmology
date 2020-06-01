<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Queue;
use App\Clinic;
use Validator;
use Session;
use Redirect;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\QueueToken;

class QueueController extends Controller
{
    protected $serverKey;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->serverKey = config('app.firebase_server_key');
    }

    /**
     * Show the add queue page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addQueue()
    {
        $clinics = Clinic::all();
        return view('addQueue', compact('clinics'));
    }

    /**
     * Store new queue
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function storeQueue(Request $request)
    {
        $input = $request->all();

        $rules = array(
            // 'queue_no' => 'required | unique:queues,queue_no',
            'queue_no' => 'required',
            'queue_no' => Rule::unique('queues')->where(function ($query){
                            return $query->whereDate('created_at', Carbon::today());
                        }),
            'clinic_id' => 'required'
        );
        $validator = Validator::make($input, $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('addQueue')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $queue = Queue::create($input);

            // redirect
            Session::flash('message', 'Successfully created a new queue!');
            return Redirect::to('dashboard');
        }
    }

    /**
     * Show the edit queue page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editQueue($id)
    {
        $queue = Queue::find($id);

        return view('editQueue', compact('queue'));
    }

    /**
     * Update the queue
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateQueue(Request $request, $id)
    {
        $input = $request->all();

        $rules = array(
            'queue_no' => 'required | unique:queues,queue_no,' . $id,
            'name' => 'required'
        );
        $validator = Validator::make($input, $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('queueManagement/editQueue/'.$id)
                ->withErrors($validator)
                ->withInput();
        } else {
            // update
            $queue = Queue::find($id);
            $queue->queue_no = $request->input('queue_no');
            $queue->name = $request->input('name');
            $queue->description = $request->input('description');
            $queue->save();

            // redirect
            Session::flash('message', 'Successfully updated queue!');
            return Redirect::to('queueManagement');
        }
    }

    /**
     * Remove the queue
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteQueue($id)
    {
        $queue = Queue::findOrfail($id);
        if($queue->delete()){
            Session::flash('message', 'Successfully deleted queue!');
            return Redirect::to('queueManagement');
        }

        Session::flash('error', 'Unable to delete queue! Pleae contact administrator.');
        return Redirect::to('queueManagement');
    }

    public function nextPatient($clinic_id)
    {
        $queue = Queue::where('clinic_id', $clinic_id)->whereDate('created_at', Carbon::today())->where('is_served', 0)->first();
        $clinic = Clinic::find($clinic_id);

        if ($queue) {
            $queue->is_served = true;
            $queue->save(); 
        } else {
            // redirect
            Session::flash('error', 'Unable to find queue, please contact administrator.');
            return Redirect::to('clinic/' . $clinic->clinic_no);
        }
        

        // redirect
        Session::flash('message', 'Successfully call next Queue Number: ' . $queue->queue_no . '!');
        return Redirect::to('clinic/' . $clinic->clinic_no);
    }

    public function nextSpecificPatient($queue_id, $clinic_id)
    {
        $queue = Queue::find($queue_id);
        $clinic = Clinic::find($clinic_id);

        if ($queue) {
            //Push notification
            $this->sendMessage($queue->queue_no, $clinic->clinic_no);
            $queue->is_served = true;
            $queue->save(); 

            
        } else {
            // redirect
            Session::flash('error', 'Unable to find queue, please contact administrator.');
            return Redirect::to('clinic/' . $clinic->clinic_no);
        }
        
        // redirect
        Session::flash('message', 'Successfully call Queue Number: ' . $queue->queue_no . '!');
        return Redirect::to('clinic/' . $clinic->clinic_no);
    }

    public function completePatient($queue_id, $clinic_id)
    {
        $queue = Queue::find($queue_id);
        $clinic = Clinic::find($clinic_id);

        if ($queue) {
            $queue->is_completed = true;
            $queue->save(); 
        } else {
            // redirect
            Session::flash('error', 'Unable to find queue, please contact administrator.');
            return Redirect::to('clinic/' . $clinic->clinic_no);
        }
        
        // redirect
        Session::flash('message', 'Successfully completed Queue Number: ' . $queue->queue_no . '!');
        return Redirect::to('clinic/' . $clinic->clinic_no);
    }

    public function transferPatient(Request $request, $queue_id)
    {
        $queue = Queue::find($queue_id);
        $clinic = Clinic::find($request->current_clinic_id);
        $transferred_clinic = Clinic::find($request->clinic_id);

        if ($queue) {
            $queue->is_served = false;
            $queue->clinic_id = $request->clinic_id;
            $queue->save(); 
        } else {
            // redirect
            Session::flash('error', 'Unable to find queue, please contact administrator.');
            return Redirect::to('clinic/' . $clinic->clinic_no);
        }
        
        // redirect
        Session::flash('message', 'Successfully transfer Queue Number: ' . $queue->queue_no . ' to Clinic Number: ' . $transferred_clinic->clinic_no . '!');
        return Redirect::to('clinic/' . $clinic->clinic_no);
    }

    private function sendMessage($queue_no, $clinic_no)
    {
        $queue_tokens = QueueToken::where("queue_no", $queue_no)->whereDate('updated_at', Carbon::today())->get();

        if ($queue_tokens) {
            foreach ($queue_tokens as $queue_token) {
                $data = [
                    "to" => $queue_token->device_token,
                    "notification" =>
                        [
                            "title" => 'It\'s your turn!',
                            "body" => "Please proceed to Clinic: " . $clinic_no,
                            "icon" => url('/logo.png')
                        ],
                ];
                $dataString = json_encode($data);
          
                $headers = [
                    'Authorization: key=' . $this->serverKey,
                    'Content-Type: application/json',
                ];
          
                $ch = curl_init();
          
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
          
                curl_exec($ch);
            }
        }
        
    }
}
