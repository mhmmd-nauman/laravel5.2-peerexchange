<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\UserRole;
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
        $this->args['account'] = $this->user->account;
        return view('home.dashboardUser', $this->args);
    }

    public function getAdminDashboard()
    {
        return view('home.dashboard', $this->args);
    }
}
