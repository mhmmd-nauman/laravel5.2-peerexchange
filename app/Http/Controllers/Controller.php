<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $userId;
    protected $user;
    protected $args;

    public function __construct()
    {
        if (Auth::check()) {
            $this->userId = Auth::id();
            $this->user = Auth::user();
        } else {
            $this->userId = null;
            $this->user = null;
        }
        $this->args = [];
    }
}
