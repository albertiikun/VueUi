<?php

namespace Domain\entities;

use Core\myvendor\defaults\uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $connection = 'USR';
}
