<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    // show the "forgot password" form (used by routes -> showLinkRequestForm / form)
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // alias for existing route that expects form()
    public function form(Request $request)
    {
        return $this->showLinkRequestForm($request);
    }

    // handle submission and send reset link (used by routes -> sendResetLinkEmail / cekEmail)
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }

    // alias for existing route that expects cekEmail()
    public function cekEmail(Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }
}
