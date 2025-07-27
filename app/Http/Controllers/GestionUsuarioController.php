<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class GestionUsuarioController extends Controller
{
    public function index(): View
    {
        return view('admin.usuarios');
    }
}
