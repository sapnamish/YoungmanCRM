<?php

namespace App\Listeners;

use App\Events\ContractorCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContractorCreatedListener
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
     * @param  ContractorCreated  $event
     * @return void
     */
    public function handle(ContractorCreated $event)
    {
        //
    }
}
