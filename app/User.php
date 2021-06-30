<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Laravel\Passport\HasApiTokens;
use AvisoNavAPI\Traits\Observable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, Filterable, Observable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name1', 'name2', 'email', 'state',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'sign_automatically' => 'boolean',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    public function getName2Attribute($value)
    {
        return $value == 'null' ? '' : $value;
    }
}
