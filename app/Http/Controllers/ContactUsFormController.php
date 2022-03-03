<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactUsFormController extends Controller
{
    // Store Contact Form data
    public function ContactUsForm(ContactUsRequest $request): \Illuminate\Http\RedirectResponse
    {
        //  Store data in database
        Contact::create($request->all());

        //  Send mail to admin
        \Mail::send('mail.mail', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'subject' => $request->get('subject'),
            'user_query' => $request->get('message'),
        ), function ($message) use ($request) {
            $message->from('test@artnen.ru');
            $message->to('roslav@icloud.com', 'Admin')->subject($request->get('subject'));
        });
        return back()->with('success', 'Мы получили ваше сообщение, и в скором времени свяжемся с вами.');
    }
}

