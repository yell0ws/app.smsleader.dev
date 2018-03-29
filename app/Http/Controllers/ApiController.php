<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNotification(Request $request){   

        if ($request->ajax()) {
            $getLeads = Auth::user()->lead()->where('notification', '=', false)->where('created_at', '>=', Carbon::now()->subMinutes(15))->first();

            if ($getLeads) {
                $update = Auth::user()->lead()->where('id', '=', $getLeads->id)->update([
                    'notification' => true,
                ]);

                return response()->json(['status' => 'new', 'amount' => $getLeads->amount, 'lead_sound' => Auth::user()->profile()->first()->lead_sound]);
            }

            return response()->json(['status' => 'empty']);
        }

        return response()->json(['permission' => 'unauthenticated']);
    }

    public function getchatAuthorize(Request $request){
         
         $app = [
            'id' => "291928",
            'key' => "4143363ee87ebc83d171",
            'secret' => "674946f73a39a354a453",
         ];

        $pusher = new \Pusher($app['key'], $app['secret'], $app['id'], ['encrypted' => true,]);

        echo $pusher->presence_auth($request->channel_name, $request->socket_id, Auth::user()->username);
    }

    public function getChatInformation(){

        $app = [
            'id' => "291928",
            'key' => "4143363ee87ebc83d171",
            'secret' => "674946f73a39a354a453",
        ];

        $pusher = new \Pusher($app['key'], $app['secret'], $app['id']);

        $data = [
            'message' => 'Hello',
        ];

        $trigger = $pusher->trigger('chats', 'error', $data);

        var_dump($trigger);
    }
}
