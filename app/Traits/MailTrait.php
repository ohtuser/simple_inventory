<?php

namespace App\Traits;

use App\Models\Admin;
use App\Models\MailCredential;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

trait MailTrait
{
    public function mail_send($receiver, $otp)
    {
        $mailCredential = MailCredential::where('status', 1)->first();

        if ($mailCredential) {
            $config = array(
                'driver'     =>     'smtp',
                'host'       =>      $mailCredential->host,
                'port'       =>      $mailCredential->port,
                'username'   =>      $mailCredential->email,
                'password'   =>      $mailCredential->password,
                'encryption' =>      $mailCredential->encryption,
                'from'       =>     array('address' => $mailCredential->email, 'name' => $mailCredential->name),
            );
            Config::set('mail', $config);
            try {
                $details = [
                    'subject' => "OTP Verification",
                    'body' => "You forgot password OTP is " . $otp,
                    'email' => $receiver,
                ];
                Mail::send(new \App\Mail\CustomMail($details));
            } catch (Exception $e) {
            }
            return true;
        }
        return true;
    }
}
