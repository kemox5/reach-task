<?php

namespace Modules\Ads\App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\HtmlString;

class AdReminder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        logger('mail send');

        return $this
            ->subject('You have an ad tomorrow')
            ->from('ads@example.com')
            ->cc('admin@example.com')
            ->text( new HtmlString('You have an ad tomorrow'));
    }
}
