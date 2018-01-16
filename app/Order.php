<?php
/**
 * Created by PhpStorm.
 * User: ToXaHo
 * Date: 23.04.2017
 * Time: 18:23
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'status'
    ];
}
