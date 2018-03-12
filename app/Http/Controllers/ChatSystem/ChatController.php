<?php

namespace App\Http\Controllers\ChatSystem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
Use App\Events\ChatEvent;

class ChatController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}


   public function chat()
   {
   	return view('chat.chat_view');
   }

   public function send()
   {
   	$message = 'hello';
   	$user = User::find(Auth::id());
   	event(new ChatEvent($message, $user));
   }
}
