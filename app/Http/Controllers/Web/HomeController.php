<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Queue;
use App\Clinic;
use Carbon\Carbon;
use App\QueueToken;

class HomeController extends Controller
{
    public function homePage()
    {
        $queueUpdates = [];

        return view('welcome', ['queueUpdates' => $queueUpdates]);
    }

    public function searchQueue(Request $request)
    {
        $queue_no = $request->search_queue;

        $queues = [];
        $your_queue = null;
        $serving_queue_no = null;
        $time_now = null;
        $clinic = null;
        $unserved_queue = null;

        $your_queue = Queue::where('queue_no', $queue_no)
                        ->whereDate('updated_at', Carbon::today())
                        ->first();

        if ($your_queue) {
            if ($request->device_token) {
                $this->updateQueueDeviceToken($queue_no, $request->device_token);
            }
        	$clinic = Clinic::find($your_queue->clinic_id);
            //Get all queues belongs to the same clinic
            $queues = Queue::where('clinic_id', $your_queue->clinic_id)->whereDate('updated_at', Carbon::today())->where('is_served', false)->get();

            //Calculate average waiting time
            if ($your_queue->is_served) {
                $unserved_queue = 'N/A, Please proceed to counter';
            } else {
                $unserved_queue = Queue::where('clinic_id', $your_queue->clinic_id)->whereDate('updated_at', Carbon::today())->where('is_served', false)->where('updated_at', '<', $your_queue->updated_at)->count();
            }

            $time_now = Carbon::now()->setTimezone('Asia/Kuala_Lumpur')->format('h:i A');
        }
        
        return view('queue.index', compact('queues', 'your_queue', 'unserved_queue', 'queue_no', 'time_now', 'clinic'));
    }

    private function updateQueueDeviceToken($queue_no, $device_token)
    {
        $queue_token = QueueToken::where('device_token', $device_token)->whereDate('updated_at', Carbon::today())->first();

        if ($queue_token) {
            //Found existing token registered, update queue_no
            $queue_token->queue_no = $queue_no;
            $queue_token->save();
        } else {
            // Not found existing token, register a new device token to the queue no
            $queue_token = new QueueToken;

            $queue_token->queue_no = $queue_no;
            $queue_token->device_token = $device_token;
            $queue_token->save();
        }
    }
}
