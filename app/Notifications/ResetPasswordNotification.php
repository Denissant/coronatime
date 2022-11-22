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
					->line('click this button to recover a password')
					->action('Reset password', route('password.reset', [$this->token, 'email' => $this->email]))
					->line('If you did not request a password reset, no further action is required.');
	}
}
