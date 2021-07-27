<?php

namespace Firebed\News\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    public function index(): Renderable
    {
        return view('user.contact.index');
    }

    public function store(Request $request): RedirectResponse
    {
        abort(403);
        $this->middleware('throttle:5,1');

        $request->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'subject'    => 'required|string',
            'email'      => 'required|string',
            'message'    => 'required|string',
        ]);

        try {
            Mail::raw($request->message, function (Message $message) use ($request) {
                $message->to('gazetemillet@hotmail.com')
                    ->bcc($request->email)
                    ->subject($request->subject);
            });
        } catch (Throwable $t) {
            return back()->with('success', FALSE);
        }

        return back()->with('success', TRUE);
    }
}
