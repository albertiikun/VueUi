<?php

namespace Core\container\port\setup\register;

use Illuminate\Contracts\Mail\Mailer as IMailer;
use Illuminate\Contracts\Mail\MailQueue;
use Illuminate\Mail\Mailer as IMail;
use Torann\GeoIP\Facades\GeoIP;

trait Aliases
{
    private function RegisterAliases($app)
    {
        $app->alias('mailer', IMail::class);
        $app->alias('mailer', IMailer::class);
        $app->alias('mailer', MailQueue::class);
        $app->alias('GeoIP', GeoIP::class);
    }
}
