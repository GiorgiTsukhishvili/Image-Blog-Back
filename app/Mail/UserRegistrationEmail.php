<?php

namespace App\Mail;

use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class UserRegistrationEmail extends Mailable
{
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
			subject: 'User Registration Email',
		);
	}

	public function content(): Content
	{
		return new Content(
			view: 'email.verification-email',
			with: [
				'name'  => $this->name,
				'route' => $this->route,
			],
		);
	}
}
