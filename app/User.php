<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'user_id', 'name', 'avatar', 'open_box', 'open_sum', 'affiliate_code', 'affiliate_profit', 'role', 'balance', 'affiliate_use'
    ];
}
