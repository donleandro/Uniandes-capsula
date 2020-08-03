<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Asahasrabuddhe\LaravelMJML\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CapsulaMjml extends Mailable
{
    use Queueable, SerializesModels;
    private $image;
    private $capsula;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($image,$capsula)
    {
      $this->image  = $image;
      $this->capsula = $capsula;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->mjml('capsula.mjml')
                    ->with([
                                    'image' => $this->image,
                                    'capsula' => $this->capsula,
                                ]);
    }
}
