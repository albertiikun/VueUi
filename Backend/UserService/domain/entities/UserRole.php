<?php

namespace Domain\entities;

use Core\myvendor\defaults\uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
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
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
