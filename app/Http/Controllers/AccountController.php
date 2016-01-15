<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 15-01-16
 * Time: 11:18 AM
 */

namespace App\Http\Controllers;


class AccountController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDeposit()
    {
        return view('account.deposit', $this->args);
    }

    public function getWithdraw()
    {
        return view('account.withdraw', $this->args);
    }
}