<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetEmail extends Mailable
{
	use Queueable, SerializesModels;

	public $name;

	public $route;

	public function __construct($route, $name)
	{
		$this->route = $route;

		$this->name = $name;
	}

	public function envelope(): Envelope
	{
		return new Envelope(
			from: new Address('support@imageechoes.ge', 'Image Echoes Support'),
			subject: 'Password Reset Email',
		);
	}

	public function content(): Content
	{
		return new Content(
			view: 'email.password-email',
		);
	}

	public function attachments(): array
	{
		return [];
	}
}
