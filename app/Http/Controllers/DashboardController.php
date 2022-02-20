<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // return view('dashboard');
        if (Auth::user() && Auth::user()->roles == 'ADMIN') {
            return view('admin-dashboard');
        } elseif (Auth::user() && Auth::user()->roles == 'GURU') {
            return view('guru-dashboard');
        } elseif (Auth::user() && Auth::user()->roles == 'COMPANY') {
            return view('company-dashboard');
        }
    }
}
