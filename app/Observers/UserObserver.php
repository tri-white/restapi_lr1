<?php

namespace App\Observers;

use App\Models\Users;

class UserObserver
{
    /**
     * Handle the Users "created" event.
     */
    public function created(Users $users): void
    {
        //
    }

    /**
     * Handle the Users "updated" event.
     */
    public function updated(Users $users): void
    {
        //
    }

    /**
     * Handle the Users "deleted" event.
     */
    public function deleted(Users $users): void
    {
        //
    }

    /**
     * Handle the Users "restored" event.
     */
    public function restored(Users $users): void
    {
        //
    }

    /**
     * Handle the Users "force deleted" event.
     */
    public function forceDeleted(Users $users): void
    {
        //
    }
}
