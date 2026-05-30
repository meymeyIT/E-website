<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\SystemAlert;  // <-- Import the model

class ContactController extends Controller
{
    // Show the contact form
    public function show()
    {
        return view('frontend.contact');
    }

    // Handle form submission
    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Create a new system alert for the contact message
        SystemAlert::create([
            'title'   => 'New Contact Message: ' . $request->subject,
            'message' => $request->message,
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'is_read' => false,
            'user_id' => null,  // or assign logged-in user id if needed
        ]);

        // Send email notification (optional)
        Mail::raw("Name: {$request->name}\nEmail: {$request->email}\n\nMessage:\n{$request->message}", function ($mail) use ($request) {
            $mail->to('your-email@example.com')
                 ->subject($request->subject)
                 ->from($request->email, $request->name);
        });

        return redirect()->back()->with('success', 'Thank you for contacting us. We will get back to you shortly!');
    }
}
