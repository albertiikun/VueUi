<?php

namespace Domain\entities;

use Core\myvendor\defaults\uuid\Uuid;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, Uuid, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'deleted',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'ipRestriction', 'deviceRestriction',
    ];

    public function UserRole()
    {
        return $this->hasOne(UserRole::class);
    }

    public function Role()
    {
        return $this->hasOneThrough(Role::class, UserRole::class, 'user_id', 'id', 'id', 'role_id');
    }
}
