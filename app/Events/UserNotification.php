<?php

namespace App\Events;

use App\Models\Notification;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserNotification
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	public function __construct(protected Notification $notification)
	{
	}

	public function broadcastOn(): array
	{
		return [
			new PrivateChannel('image-notifications.' . auth()->user()->id),
		];
	}

	public function broadcastAs(): string
	{
		return 'notifications';
	}
}
