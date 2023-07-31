<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Student;

class AnnouncementController extends Controller
{
    public function index() {
        return inertia('Announcement/Index');
    }

    public function send(Request $request) 
    {
        $request->validate([
            'subject' => 'required|string',
            'content' => 'required|string'
        ]);

        $emails = Student::pluck('email');

        // dd($request);

        if($request->content != null && $request->subject != null) {
            $subject = $request->subject;
            $content = $request->content;

            foreach($emails as $e) {

                Mail::send('emails.announcement', ['content' => $content], function($message) use ($subject, $e) {
                    $message->to($e);
                    $message->subject($subject);
                });
            }
            return back()->banner('Announcement mail has been sent to all students!');
        }
    }
}
