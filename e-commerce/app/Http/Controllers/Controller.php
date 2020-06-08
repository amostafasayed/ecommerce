<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkAuthenticate($checkAbleUserId) {
        $user = User::find(auth()->user()->id);
        if ($checkAbleUserId != auth()->user()->id && $user->role == 'user') {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'You are not valid person for that. Please try again.'
            ]);
        }
    }
    public function invalidMessage() {
        return redirect()->back()->with([
                'type' => 'error',
                'message' => 'You are not valid person for that. Please try again.'
            ]);
    }


    public function sendEmail($emailBlade, $data, $subject, $toEmail){
        Mail::send($emailBlade,[
            'data' => $data
        ], function($message) use ($subject, $toEmail)
        {
            $message->from(env('SEND_MAIL_ADDRESS'));
            $message->subject($subject);
            $message->to($toEmail);
        });
    }
}
