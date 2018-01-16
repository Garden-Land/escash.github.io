<?php
/**
 * Created by PhpStorm.
 * User: ToXaHo
 * Date: 22.04.2017
 * Time: 21:40
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'sell_price', 'type', 'case_id', 'img', 'chance'
    ];
}
