<?php

namespace Core\myvendor\defaults\events;

use Illuminate\Queue\SerializesModels;

abstract class Event
{
    use SerializesModels;
}
