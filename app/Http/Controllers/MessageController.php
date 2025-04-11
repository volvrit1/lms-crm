<?php 

namespace App\Http\Controllers;

use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Display all threads (inbox)
    public function index()
    {
        $threads = Thread::forUser(Auth::id())->latest('updated_at')->get();
        return view('messages.index', compact('threads'));
    }

    // Show a specific thread
    public function show($id)
    {
        $thread = Thread::findOrFail($id);
        $thread->markAsRead(Auth::id());
        return view('messages.show', compact('thread'));
    }

    // Store a new message
    public function store(Request $request)
    {
        $thread = Thread::create([
            'subject' => $request->input('subject'),
        ]);

        // Message
        $message = Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => $request->input('message'),
        ]);

        // Add participant
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'last_read' => new \DateTime(),
        ]);

        return redirect()->route('messages');
    }
}

?>