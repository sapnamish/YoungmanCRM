<?php

namespace App\Listeners;

use App\Events\ActivityCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivityCreatedListener
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
     * @param  ActivityCreated  $event
     * @return void
     */
    public function handle(ActivityCreated $event)
    {
        //
    }
}
