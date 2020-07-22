<?php

namespace Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class UserIpRestriction extends Model
{

    protected $connection = 'USR';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}
