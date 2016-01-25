<?php
/**
 * Created by PhpStorm.
 * User: mbassale
 * Date: 15-01-16
 * Time: 11:05 AM
 */

namespace App\Http\Controllers;

class SettingsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function getIndex()
    {
        return view('settings.index', $this->args);
    }
}