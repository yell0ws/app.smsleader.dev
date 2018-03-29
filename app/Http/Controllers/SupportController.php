<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use Setting;
use SumanIon\CloudFlare;
use App\Http\Requests\Support\ContactRequest;
use Exception;

class SupportController extends Controller{

    public function __construct(){

        $this->middleware('auth');
    }

    public function getFaq(){

        return view('support.faq');
    }

    public function getContact(){

        return view('support.contact');
    }

    public function postContact(ContactRequest $request){

        if ($request->get('section') == 'global') {

            $to = Setting::get('support_mail_global');
           $subject = $request->get('title')." - Od użytkownika ". Auth::user()->username;

        }else if($request->get('section') == 'technical'){

            $to = Setting::get('support_mail_technical');
            $subject = $request->get('title')." - Od użytkownika ". Auth::user()->username;

        }else if ($request->get('section') == 'finance') {

            $to = Setting::get('support_mail_finance');
            $subject = $request->get('title')." - Od użytkownika ". Auth::user()->username;

        }

        Mail::send('emails.contact', ['username' => Auth::user()->username, 'title' => $request->get('title'), 'messages' => clean($request->get('messages')), 'ip_address' => Cloudflare::ip()], function ($message) use($to, $subject){

            $message->to($to);
            $message->subject($subject);

        });

        return redirect()->route('support.contact')->with('success', 'Wiadomość została wysłana pomyślnie! Postaramy się w jak najszybszym czasie odpowiedzieć na nią.');
    }
}
