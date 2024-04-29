<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Password_resets;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\HtmlString;


class ResetPasswordForApi extends Notification
{
    use Queueable;

    public $token;
    public $lang;

    public function __construct($user, $lang)
    {
        $this->lang = $lang;
        $random = rand(10000, 99999); // 4-digit token
        $this->token = $random;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $pasRes = new Password_resets;
        $pasRes->email = $notifiable->email;
        $pasRes->token = Hash::make($this->token);
        $pasRes->save();

        $emailSubject = Lang::get('passwords.reset_password.subject', [], $this->lang);
        
        $emailMessage = Lang::get('passwords.reset_password.message', [], $this->lang);
        if($this->lang == 'ar'){
            $emailMessage .= '<br><br><strong>رمز التحقق: </strong>' . $this->token;
        }else{
            $emailMessage .= '<br><br><strong>Token: </strong>' . $this->token;
        }
        return (new MailMessage)
            ->subject($emailSubject)
            ->line(new HtmlString($emailMessage));
    }



    public function toArray($notifiable)
    {
        return [];
    }
}