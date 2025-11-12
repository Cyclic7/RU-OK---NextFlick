<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewMovieNotification extends Notification
{
    use Queueable;

    protected $movie;

    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->movie->id,
            'title' => $this->movie->title,
            'poster' => $this->movie->poster_url,
        ];
    }
}
