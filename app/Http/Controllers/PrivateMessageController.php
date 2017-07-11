<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrivateMessage;

class PrivateMessageController extends Controller
{
    public function getUserNotifications(Request $request)
    {
    	$notifications = PrivateMessage::where('read', 0)
    			->where('receiver_id', $request->user()->id)
    			->orderBy('created_at', 'desc')
    			->get();
		return response(['data' => $notifications], 200);
    }
    public function getPrivateMessages(Request $request)
    {
		$pms = PrivateMessage::where('receiver_id', $request->user()->id)
    			->orderBy('created_at', 'desc')
    			->get();
		return response(['data' => $pms], 200);
    }
    public function getPrivateMessageById(Request $request)
    {
		$pm = PrivateMessage::where('receiver_id', $request->input('id'))->first();
		if ($pm->read == 0) {
			$pm->read = 1;
			$pm->save();
		}

		return response(['data' => $pm], 200);


    }
    public function getPrivateMessageSent(Request $request)
    {
		$pms = PrivateMessage::where('sender_id', $request->user()->id)
    			->orderBy('created_at', 'desc')
    			->get();
		return response(['data' => $pms], 200);
    }
    public function sendPrivateMessage(Request $request)
    {
    	$attributes = [
    		'sender_id' => $request->sender_id,
    		'reciever_id' => $request->reciever_id,
    		'subject' => $request->subject,
    		'message' => $request->message,
    		'read' => 0
    	];
    	$pm = PrivateMessage::create($attributes);
    	$data = PrivateMessage::where('id', $pm->id)->first();
    	return response(['data' => $data], 201);
    }

}
