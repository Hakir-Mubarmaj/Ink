<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function showContactForm()
    {
        return view('contact.form');
    }
    public function submitContactForm(Request $request)
    {
        $user = Auth::user();
        $message = $request->input('message');

        $contact = new Contact();
        $contact->user_id = $user->id;
        $contact->message = $message;
        $contact->status = 'pending'; // Or any default status
        $contact->save();

        return redirect('/')->with('success', 'Book contribution added and pending approval');
    }
}
