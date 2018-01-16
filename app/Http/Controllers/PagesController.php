<?php
/**
 * Created by PhpStorm.
 * User: ToXaHo
 * Date: 21.04.2017
 * Time: 19:26
 */

namespace App\Http\Controllers;

class PagesController extends Controller
{

    public function index()
    {
        return view('pages.index');
    }

}