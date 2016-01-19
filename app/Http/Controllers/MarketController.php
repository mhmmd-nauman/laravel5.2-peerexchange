<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 15-01-16
 * Time: 11:31 AM
 */

namespace App\Http\Controllers;


use App\Models\Currency;
use Illuminate\Http\Request;

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
        $this->args['currencies'] = Currency::where('code', '<>', $this->user->account->currency)->orderBy('name')->get();
        $this->args['account'] = $this->user->account;
        return view('market.sell', $this->args);
    }

    public function postSell(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric',
            'toCurrency' => 'required',
            'rate' => 'required|numeric'
        ]);

        $request->session()->flash('message', 'Sell Successful');
        return redirect()->route('market.sell');
    }
}