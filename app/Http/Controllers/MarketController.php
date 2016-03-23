<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 15-01-16
 * Time: 11:31 AM
 */

namespace App\Http\Controllers;
use App\Models\Account;
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
        $accounts = $this->user->account;
        assert($accounts != null, 'User with null account!');
        //$this->args['currencies'] = Currency::where('code', '<>', $account->currency)->orderBy('name')->get();
        $this->args['accounts'] = $accounts;
        foreach($accounts as $account){
            $moneySells = MoneySell::where('account_id', '<>', $account->id)->where('sold', false)->orderBy('created_at', 'desc')->get();
        }
        $this->args['moneySells'] = $moneySells;
        return view('market.buy', $this->args);
    }

    public function getMakeBuy($id, Request $request, MarketService $marketService)
    {
        try {
            $moneySell = MoneySell::findOrFail($id);
           //;
            //echo "tt";
            //exit;
            //$account = $this->user->account;
            $transaction = $marketService->buy( $this->user->id, $moneySell);
            //echo "kk".$this->user->id;
            //exit;
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
        $accounts = $this->user->account;
        assert($accounts != null, 'User with null account!');
        //$this->args['currencies'] = Currency::where('code', '<>', $account->currency)->orderBy('name')->get();
        //$this->args['moneySells'] = $account->moneySells->where('sold', 'false');
        $this->args['accounts'] = $accounts;
        return view('market.sell_currency', $this->args);
    }
    
    public function getSellCurrency($id)
    {
        $account = Account::findOrFail($id);
        assert($account != null, 'User with null account!');
        $this->args['currencies'] = Currency::where('code', '<>', $account->currency)->orderBy('name')->get();
        $this->args['moneySells'] = $account->moneySells->where('sold', 'false');
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
        $from_currency= $request->input('from_currency');
        $rate = floatval($request->input('rate'));

        try {
            $transaction = $marketService->sell($this->user->id, $currency, $amount, $rate,$from_currency);
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