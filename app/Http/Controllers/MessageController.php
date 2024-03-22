<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        // Check if the user is authenticated as a company
        if (!auth()->guard('company')->check()) {
            return redirect()->back()->with('error', 'You must be logged in as a company to send a message.');
        }
    
        $request->validate([
            'receiver_id' => 'required|integer',
            'job_id' => 'required|integer',
            'message' => 'required|string',
        ]);
    
        // Ensure that the sender_id is retrieved from the authenticated company
        $senderId = auth()->guard('company')->user()->id;
    
        Message::create([
            'sender_id' => $senderId,
            'receiver_id' => $request->receiver_id,
            'job_id' => $request->job_id,
            'message' => $request->message,
        ]);
    
        return redirect()->back()->with('success', 'Message sent successfully.');
    }
    

    public function viewMessages()
    {
        $userId = auth()->id();

        $messages = Message::where('sender_id', $userId)
                           ->orWhere('receiver_id', $userId)
                           ->with(['sender', 'receiver', 'job'])
                           ->orderBy('created_at', 'desc')
                           ->paginate(10);

        return view('messages', compact('messages'));
    }
    public function showMessageForm()
{
    // Here you can fetch the receiver ID and job ID, for example:
    $receiverId = 1; // Replace with actual receiver ID
    $jobId = 1; // Replace with actual job ID

    return view('company.sendmessage', compact('receiverId', 'jobId'));
}
}
