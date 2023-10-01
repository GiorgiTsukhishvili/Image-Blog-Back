<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Jobs\MailJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens;

	use HasFactory;

	use Notifiable;

	protected $fillable = [
		'name',
		'email',
		'password',
		'background_image',
		'image',
		'verification_token',
	];

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
		'password'          => 'hashed',
	];

	public function sendEmailVerificationMail()
	{
		$token = sha1(time());

		$route = URL::temporarySignedRoute(
			'user.verify',
			now()->addMinutes(30),
			['token' => $token],
		);

		$this->verification_token = $token;

		$this->save();

		$frontUrl = config('app.front-url') . '?type=register&register-link=' . $route;

		dispatch(new MailJob($this->email, $frontUrl, $this->name, 'App\Mail\UserRegistrationEmail'));
	}

	public function blogs()
	{
		return $this->hasMany(Blog::class);
	}

	public function collections()
	{
		return $this->hasMany(BlogCollection::class);
	}

	public function subscribers()
	{
		return $this->hasMany(Subscribe::class);
	}
}
