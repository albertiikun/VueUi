<?php

namespace Domain\entities;

use Core\myvendor\defaults\uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
}
