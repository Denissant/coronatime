<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
	use Queueable;

	public string $token;

	public function __construct($token, $email)
	{
		$this->token = $token;
		$this->email = $email;
	}

	public function via($notifiable)
	{
		return ['mail'];
	}

	public function toMail($notifiable)
	{
		return (new MailMessage)
					->subject(__('auth.reset'))
					->line(__('auth.click_to_reset'))
					->action(__('auth.reset'), route('password.reset', [$this->token, 'email' => $this->email]))
					->line(__('auth.reset_info'));
	}
}
