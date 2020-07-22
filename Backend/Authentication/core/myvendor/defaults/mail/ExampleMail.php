<?php

namespace Core\myvendor\defaults\mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExampleMail extends Mailable
{

    use Queueable,
        SerializesModels;

    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    //build the message.
    public function build()
    {
        return $this->view('my-email', ['data' => $this->data]);
    }
}
