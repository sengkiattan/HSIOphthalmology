<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Queue;
use App\Clinic;
use Carbon\Carbon;

class HomeController extends Controller
{
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
                        // ->whereDate('created_at', Carbon::today())
                        ->first();

        if ($your_queue) {
        	$clinic = Clinic::find($your_queue->clinic_id);
            //Get all queues belongs to the same clinic
            $queues = Queue::where('clinic_id', $your_queue->clinic_id)->whereDate('created_at', Carbon::today())->where('is_served', false)->get();

            //Calculate average waiting time
            if ($your_queue->is_served) {
                $unserved_queue = 'N/A, Please proceed to counter';
            } else {
                $unserved_queue = Queue::where('clinic_id', $your_queue->clinic_id)->whereDate('created_at', Carbon::today())->where('is_served', false)->where('created_at', '<', $your_queue->created_at)->count();
            }

            $time_now = Carbon::now()->setTimezone('Asia/Kuala_Lumpur')->format('h:i A');
        }
        
        return view('queue.index', compact('queues', 'your_queue', 'unserved_queue', 'queue_no', 'time_now', 'clinic'));
    }
}
