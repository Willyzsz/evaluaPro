<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class OverallController extends Controller
{
    public function dashboard(): View
    {
        return view('dashboard');
    }
    public function dashboardPuestos(): View
    {
        return view('admin.dashboard-puestos');
    }
    public function dashboardTemas(): View
    {
        return view('dashboard.dashboard-temas');
    }
}