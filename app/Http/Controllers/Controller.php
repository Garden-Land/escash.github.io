<?php

namespace App\Http\Controllers;

use App\Config;
use App\Withdraw;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $user;
    protected $config;
    protected $withdrawLast;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            view()->share('u', $this->user);
            return $next($request);
        });
        $this->config = Config::where('id', 1)->first();
        $this->withdrawLast = Withdraw::where('status', 0)->count('id');
        view()->share('config', $this->config);
        view()->share('withdrawLast', $this->withdrawLast);
    }
}
