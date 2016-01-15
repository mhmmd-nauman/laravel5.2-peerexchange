<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 15-01-16
 * Time: 11:31 AM
 */

namespace App\Http\Controllers;


class MarketController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getBuy()
    {
        return view('market.buy', $this->args);
    }

    public function getSell()
    {
        return view('market.sell', $this->args);
    }
}