<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailJob implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	public $email;

	public $frontUrl;

	public $name;

	public $type;

	public function __construct($email, $frontUrl, $name, $type)
	{
		$this->email = $email;
		$this->frontUrl = $frontUrl;
		$this->name = $name;
		$this->type = $type;
	}

	public function handle(): void
	{
		Mail::to($this->email)->send(new $this->type($this->frontUrl, $this->name));
	}
}
