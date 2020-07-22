<?php

namespace Domain\Entities;

use Core\myvendor\defaults\uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class EmailConfirmation extends Model
{
    use Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}
