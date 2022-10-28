<?php

namespace App\Listeners;

use App\Mail\WelcomeContestEntryMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class WelcomeCotnestEntryNotification
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if ($to = $this->getToEmail($event)) {
            Mail::to($to)
                ->send(new WelcomeContestEntryMail);
        }
    }

    private function getToEmail($event) 
    {
        return optional(optional($event)->contestEntry)->email;
    }
}
