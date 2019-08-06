<?php

namespace App\Listeners;

use App\Events\SendEmailOfContactUsEvent;
use App\Mail\ContactUsMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EmailSendOfContactUsListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  SendEmailOfContactUsEvent  $event
     * @return void
     */
    public function handle(SendEmailOfContactUsEvent $event)
    {
//        sleep(10);
//        dd('hello');
        Mail::to('27dhjetor@gmail.com')->send(new ContactUsMail($event->contact_us));
    }
}
