<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 15-01-16
 * Time: 11:31 AM
 */

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\MoneySell;
use App\Services\MarketService;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getBuy()
    {
        $account = $this->user->account;
        assert($account != null, 'User with null account!');
        $this->args['currencies'] = Currency::where('code', '<>', $account->currency)->orderBy('name')->get();
        $this->args['account'] = $account;
        $moneySells = MoneySell::where('account_id', '<>', $account->id)->orderBy('created_at', 'desc')->get();
        $this->args['moneySells'] = $moneySells;
        return view('market.buy', $this->args);
    }

    public function getMakeBuy($id, Request $request, MarketService $marketService)
    {
        try {
            $moneySell = MoneySell::findOrFail($id);
            $account = $this->user->account;
            $transaction = $marketService->buy($account, $moneySell);
            if ($transaction) {
                $request->session()->flash('message', 'Buy Successful');
                return redirect()->route('market.buy');
            } else {
                $request->session()->flash('message', 'Buy Failed');
                return redirect()->back()->withInput();
            }
        } catch (\Exception $ex) {
            $request->session()->flash('error', 'Buy Failed: ' . $ex->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function getSell()
    {
        $account = $this->user->account;
        assert($account != null, 'User with null account!');
        $this->args['currencies'] = Currency::where('code', '<>', $account->currency)->orderBy('name')->get();
        $this->args['moneySells'] = $account->moneySells;
        $this->args['account'] = $account;
        return view('market.sell', $this->args);
    }

    public function postSell(Request $request, MarketService $marketService)
    {
        $this->validate($request, [
            'amount' => 'required|numeric',
            'toCurrency' => 'required',
            'rate' => 'required|numeric'
        ]);

        $amount = floatval($request->input('amount'));
        $currency = $request->input('toCurrency');
        $rate = floatval($request->input('rate'));

        try {
            $transaction = $marketService->sell($this->user->account, $currency, $amount, $rate);
            if ($transaction) {
                $request->session()->flash('message', 'Sell Successful');
                return redirect()->route('market.sell');
            } else {
                $request->session()->flash('message', 'Sell Failed');
                return redirect()->back()->withInput();
            }
        } catch (\Exception $ex) {
            $request->session()->flash('error', 'Sell Failed: ' . $ex->getMessage());
            return redirect()->back()->withInput();
        }
    }
}