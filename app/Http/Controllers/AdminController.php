<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AdminController extends Controller
{

    public function index(): View
    {
        return view('admin.dashboard');
    }
    public function examenes(): View
    {
        return view('admin.examenes');
    }
}