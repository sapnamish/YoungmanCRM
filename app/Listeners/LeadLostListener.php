<?php

namespace App\Listeners;

use App\Events\LeadLost;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LeadLostListener
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
     * @param  LeadLost  $event
     * @return void
     */
    public function handle(LeadLost $event)
    {
        //
    }
}
