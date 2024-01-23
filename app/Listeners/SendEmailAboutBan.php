<?php

namespace App\Listeners;

use App\Events\UserBanned;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailAboutBan implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserBanned $event): void
    {
        Mail::to($event->user)->send(new Message());
    }
}
