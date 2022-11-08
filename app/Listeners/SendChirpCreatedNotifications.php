<?php

namespace App\Listeners;

use App\Events\ChirpCreated;
use App\Models\User;
use App\Notifications\NewChirp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendChirpCreatedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ChirpCreated  $event
     * @return void
     */
    public function handle(ChirpCreated $event)
    {
        foreach (User::where('id', '!=', $event->chirp->user_id)->cursor() as $user) {
            Log::info("Notifing User {$user} with Message {$event->chirp->message}");
            // TODO: Setup env data to connect to mail server
            // $user->notify(new NewChirp($event->chirp));
        }
    }
}
