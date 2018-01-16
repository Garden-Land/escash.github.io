<?php
/**
 * Created by PhpStorm.
 * User: ToXaHo
 * Date: 22.04.2017
 * Time: 21:40
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    protected $table = 'cases';

    protected $fillable = [
        'name', 'price', 'type', 'total_given', 'img', 'items'
    ];
}
