<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Queue;
use Carbon\Carbon;

class HomeController extends Controller
{
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
