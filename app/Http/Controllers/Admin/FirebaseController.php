<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

class FirebaseController extends Controller
{
    public function sendAll(Request $request)
    {
    	$recipients = User::whereNotNull('device_token')
    		->pluck('device_token')->toArray();
    	//dd($recipients);

    	fcm()
    		->to($recipients)
    		->notification([
    			'title' => $request->input('title'),
    			'body' => $request->input('body')
    		])
    		->send();

    	$notification = 'Notificatión enviada a todos los usuarios (Android).';
    	return back()->with(compact('notification'));
    }
}
