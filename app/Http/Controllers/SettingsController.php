<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 15-01-16
 * Time: 11:05 AM
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Session;

class SettingsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $current_user = $this->user;
        echo "<pre>";
        print($current_user->id);
        echo "</pre>";
        $this->args['current_user'] = $current_user;
        return view('settings.index', $this->args);
    }
    public function updateSetting(Request $request)
    {
        //
        $user = User::findOrFail($this->user->id);
        $this->validate($request, [
            'mobile' => 'required',
            'nationalid'=>'required'
        ]);
        //$input = $request->all();
        $mobile = $request->input('mobile');
        $nationalid = $request->input('nationalid');
        $dob = $request->input('dob');
        $address = $request->input('address');
        $email = $request->input('email');
        $country_code = $request->input('country_code');
        $personal_bank_account = $request->input('personal_bank_account');
        $receiver_bank_account = $request->input('receiver_bank_account');
        $receiver_country_code = $request->input('receiver_country_code');
        $receiver_bank_account_name = $request->input('receiver_bank_account_name');
        
        $user->mobile = $mobile;
        $user->nationalid = $nationalid;
        $user->dob = $dob;
        $user->address = $address;
        $user->email = $email;
        $user->country_code = $country_code;
        $user->personal_bank_account = $personal_bank_account;
        $user->receiver_bank_account = $receiver_bank_account;
        $user->receiver_country_code = $receiver_country_code;
        $user->receiver_bank_account_name = $receiver_bank_account_name;
        
        $user->save();
        Session::flash('message', 'Data successfully updated!');
        return redirect()->back();
    }
}