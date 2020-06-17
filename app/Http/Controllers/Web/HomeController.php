<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Queue;
use App\Clinic;
use Carbon\Carbon;
use App\QueueToken;
use App\QueueUpdates;

class HomeController extends Controller
{
    public function homePage()
    {
        $queueUpdates = QueueUpdates::whereDate('updated_at', Carbon::today())->orderBy('updated_at', 'desc')->take(4)->get();

        return view('welcome', ['queueUpdates' => $queueUpdates]);
    }

    public function test()
    {
        return $this->homePage();
    }

    public function searchQueue($queue_no)
    {
        if (!$queue_no) {
            return;
        }
        $queueUpdates = QueueUpdates::whereDate('updated_at', Carbon::today())->orderBy('updated_at', 'desc')->take(4)->get();

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
        
        return view('queue.index', compact('queues', 'your_queue', 'unserved_queue', 'queue_no', 'time_now', 'clinic', 'queueUpdates'));
    }
}
