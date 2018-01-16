<?php
/**
 * Created by PhpStorm.
 * User: ToXaHo
 * Date: 23.04.2017
 * Time: 11:03
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    protected $table = 'live_drop';

    protected $fillable = [
        'user_id', 'item_id', 'case_id'
    ];
}
