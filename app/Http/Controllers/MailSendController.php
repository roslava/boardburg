<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;


class MailSendController extends Controller
{
    public function MailSend(Request $request): RedirectResponse
    {
        $currentUser = auth()->user();
        $details = [
            'name' => $currentUser['name'],
            'role' => $currentUser['role'],
            'email' => $request['email_for_feedback'],
            'message' => $request['message']
        ];
        Gate::authorize('show_message_send');
        Mail::to('roslav@icloud.com')->send(new ContactMail($details));
        return back()->with('message_sent', 'Сообщение администратору отправлено.');
    }
}
