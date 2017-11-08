<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpJunior\LaravelVideoChat\Facades\Chat;
use PhpJunior\LaravelVideoChat\Models\File\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
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
    public function index()
    {
        $groups = Chat::getAllGroupConversations();
        $threads = Chat::getAllConversations();

        return view('home')->with([
            'threads' => $threads,
            'groups'  => $groups
        ]);
    }

    public function chat($id)
    {
        $conversation = Chat::getConversationMessageById($id);

        return view('chat')->with([
            'conversation' => $conversation
        ]);
    }

    public function groupChat($id)
    {
        $conversation = Chat::getGroupConversationMessageById($id);

        return view('group_chat')->with([
            'conversation' => $conversation
        ]);
    }

    public function send(Request $request)
    {
        Chat::sendConversationMessage($request->input('conversationId'), $request->input('text'));
    }

    public function groupSend(Request $request)
    {
        Chat::sendGroupConversationMessage($request->input('groupConversationId'), $request->input('text'));
    }

    public function sendFilesInConversation(Request $request)
    {
        Chat::sendFilesInConversation($request->input('conversationId') , $request->file('files'));
    }

    public function sendFilesInGroupConversation(Request $request)
    {
        Chat::sendFilesInGroupConversation($request->input('groupConversationId') , $request->file('files'));
    }
}
