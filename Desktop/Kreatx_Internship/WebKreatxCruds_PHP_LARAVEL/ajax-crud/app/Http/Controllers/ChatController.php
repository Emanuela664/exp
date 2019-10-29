<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\ChatMessage;
use Response;
use DB;
use Auth;


class ChatController extends Controller
{
    public function sendMessage()
    {
        $user_name = Auth::User()->name;

        $username = Input::get('username');
        $text = Input::get('text');
        $chatMessage = new ChatMessage();
        $chatMessage->sender_username = $user_name;
        $chatMessage->sender_username = $username;
        $chatMessage->message = $text;
        $chatMessage->save();

    }

    public function isTyping()
    {
        $username = Input::get('username');

        $chat = Chat::find(1);
        if ($chat->user1 == $username)
            $chat->user1_is_typing = true;
        else
            $chat->user2_is_typing = true;
        $chat->save();
    }
    public function notTyping()
    {
        $username = Input::get('username');
        $chat = Chat::find(1);
        if ($chat->user1 == $username)
            $chat->user1_is_typing = false;
        else
            $chat->user2_is_typing = false;
        $chat->save();
    }

    public function retrieveChatMessages()
    {
       $username = Input::get('username');
        $message = ChatMessage::latest()
        ->where('sender_username', '!=', $username)
        ->where('read', '=', false)
        ->first();
         if ($message)
         {
           $message->read = true;
          $message->save();
          return response()->json(['success' => $message]);


    }
}
    public function retrieveAll()
    {
        $username = Input::get('username');
         $message = ChatMessage::all();
         return Response::json($message);
        $chatmessage= DB::table('chat_messages')->select('id','sender_username','message')->get();

         if (count($chatmessage) > 0)
         {
            return response()->json(['success' => $message]);

         }
    }

    public function retrieveTypingStatus()
    {
        $username = Input::get('username');

        $chat = Chat::find(1);
        if ($chat->user1 == $username)
        {
            if ($chat->user2_is_typing)
                return $chat->user2;
        }
        else
        {
            if ($chat->user1_is_typing)
                return $chat->user1;
        }
    }

}
