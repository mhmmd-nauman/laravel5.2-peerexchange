<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\UserRole;
use App\Models\Currency;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        if ($this->user->role == UserRole::ADMIN) {
            return redirect()->route('admin.dashboard');
        }
        $this->args['Currencies'] = Currency::all();
        //print_r($this->args['Currencies']);
        $this->args['accounts'] = $this->user->account;
        //echo "<pre>";
        //print_r($this->args['accounts']);
        //echo "</pre>";
        return view('home.dashboardUser', $this->args);
    }

    public function getAdminDashboard()
    {
        return view('home.dashboard', $this->args);
    }
}
