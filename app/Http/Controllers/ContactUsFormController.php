<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\MessageBag;


class ContactUsFormController extends Controller
{
    /**
     * @param ContactUsRequest $request
     * @return RedirectResponse
     */
    public function ContactUsForm(ContactUsRequest $request, MessageBag $errors):RedirectResponse
    {
        $contact = new Contact;
        $contact->fill($request->all());
        $contact->save(); //Store data in database

        //  Send mail to admin
        \Mail::send('mail.mail', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'subject' => $request->get('subject'),
            'user_query' => $request->get('message'),
        ), function ($message) use ($request) {
            $message->from(Config::get('constants.EMAIL_FROM'));
            $message->to(Config::get('constants.EMAIL_TO'), 'Admin')->subject($request->get('subject'));
        });





            return back()->with('success', 'Мы получили ваше сообщение, и в скором времени свяжемся с вами.');





     }

    /**
     * @return JsonResponse
     */
    public function reloadCaptcha(): JsonResponse
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
