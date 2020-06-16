<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\PushDemo;
use App\Guest;
use Auth;
use Notification;
use Carbon\Carbon;

class PushController extends Controller
{
    /**
     * Store the PushSubscription.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        $this->validate($request,[
            'pushSubscription.endpoint'    => 'required',
            'pushSubscription.keys.auth'   => 'required',
            'pushSubscription.keys.p256dh' => 'required',
            'queue_no'    => 'required'
        ]);
        $pushSubscription = $request->pushSubscription;
        $endpoint = $pushSubscription['endpoint'];
        $token = $pushSubscription['keys']['auth'];
        $key = $pushSubscription['keys']['p256dh'];
        $queue_no = $request->queue_no;
        $user = Guest::firstOrCreate([
            'endpoint' => $endpoint
        ]);

        $user->queue_no = $queue_no;
        $user->save();

        $user->updatePushSubscription($endpoint, $key, $token, $request->contentEncoding);
        
        return response()->json(['success' => true],200);
    }
}
