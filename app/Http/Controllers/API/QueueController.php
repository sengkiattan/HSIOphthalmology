<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Queue;
use App\Http\Requests;
use Validator;
use Carbon\Carbon;

class QueueController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queue = Queue::all();

        return $this->sendResponse($queue->toArray(), 'Queues retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'queue_no' => 'required',
            'clinic_no' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $queue = Queue::create($input);

        return $this->sendResponse($queue->toArray(), 'Queue created successfully.');

        // $queue = new Queue;
        // $queue->salary = $request->input('salary');
        // $queue->queue_name = $request->input('queue_name');
        // $queue->clinic_no = $request->input('job');
        // $queue->save();
        // return new QueueResource($queue);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $queue = Queue::where('queue_no', $id)->first();

        if (is_null($queue)) {
            // return $this->sendError('Queue not found.');
            return null;
        }

        //Get all queues belongs to the same clinic
        $queues = Queue::where('clinic_no', $queue->clinic_no)->whereDate('created_at', Carbon::today())->get();

        // return $queues->toArray();

        return $this->sendResponse($queues->toArray(), 'Queues by No. retrieved successfully.');

        // $Queue = Queue::find($id); //id comes from route
        // if($Queue){
        //     return new QueueResource($Queue);
        // }
        // return "Queue Not found"; // tqueueorary error
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'queue_no' => 'required',
            'clinic_no' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $queue = Queue::find($id);
        $queue->queue_no = $request->input('queue_no');
        $queue->clinic_no = $request->input('clinic_no');
        $queue->save();

        return $this->sendResponse($queue->toArray(), 'Queue updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $queue = Queue::findOrfail($id);
        if($queue->delete()){
            return $this->sendResponse($queue->toArray(), 'Queue deleted successfully.');
        }
        return "Error while deleting";
    }

    /**
     * Update is_served or next patient
     *
     * @param  int  $clinic_no
     * @return \Illuminate\Http\Response
     */
    public function nextQueue($clinic_no)
    {
        $queue = Queue::where('clinic_no', $clinic_no)->whereDate('created_at', Carbon::today())->where('is_served', 0)->first();

        if (is_null($queue)) {
            return $this->sendError('Queue not found.');
        }

        //Update the queue to be served
        $queue->is_served = true;
        $queue->save();

        return $this->sendResponse($queue->toArray(), 'Queue is_served updated successfully.');
    }

    public function searchQueue(Request $request)
    {
        $queue_no = $request->search_queue;

        $queues = [];
        $your_queue = null;
        $serving_queue_no = null;
        $unserved_queue = null;
        $time_now = null;

        $your_queue = Queue::where('queue_no', $queue_no)
                        // ->whereDate('created_at', Carbon::today())
                        ->first();

        if ($your_queue) {
            //Get all queues belongs to the same clinic
            $queues = Queue::where('clinic_no', $your_queue->clinic_no)->whereDate('created_at', Carbon::today())->where('is_served', false)->get();

            $serving_queue = Queue::where('clinic_no', $your_queue->clinic_no)->whereDate('created_at', Carbon::today())->where('is_served', true)->orderBy('created_at', 'DESC')->first();
            $serving_queue_no = null;
            if ($serving_queue) {
                $serving_queue_no = $serving_queue->queue_no;
            }

            //Calculate average waiting time
            if ($your_queue->is_served) {
                $estimate_waiting_time = 'N/A';
            } else {
                $unserved_queue = Queue::where('clinic_no', $your_queue->clinic_no)->whereDate('created_at', Carbon::today())->where('is_served', false)->where('created_at', '<', $your_queue->created_at)->count();
            }

            $time_now = Carbon::now()->setTimezone('Asia/Kuala_Lumpur')->format('h:i A');
        }
        
        return view('queue.index', compact('queues', 'your_queue', 'serving_queue_no', 'unserved_queue', 'queue_no', 'time_now'));
    }
}
