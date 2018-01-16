<?php
/**
 * Created by PhpStorm.
 * User: ToXaHo
 * Date: 23.04.2017
 * Time: 19:19
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $table = 'withdraw';

    protected $fillable = [
        'payway', 'amount', 'status', 'user_id'
    ];
}
