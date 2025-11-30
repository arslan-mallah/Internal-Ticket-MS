<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Notifications\CommentAdded;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'content' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        // 1️⃣ Upload file
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        // 2️⃣ Create comment with attachment
        $comment = $ticket->comments()->create([
            'user_id'   => $request->user()->id,
            'content'   => $request->content,
            'attachment' => $attachmentPath,   // <-- Now it's defined!
        ]);

        // 3️⃣ Notify ticket creator
        $ticket->user->notify(new CommentAdded($ticket));

        return redirect()->back();
    }
}
