<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }
    
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'subject' => 'required|max:255',
            'message' => 'required|min:10',
            'newsletter' => 'nullable|boolean'
        ]);
        
        // Here you can:
        // 1. Save to database
        // 2. Send email
        // 3. Send notification
        
        // For now, just return success
        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}