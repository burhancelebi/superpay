<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $user = auth()->user();

        return view('frontend.users.profile', compact('user'));
    }

    public function transactions(Request $request)
    {
        $user = auth()->user();

        return view('frontend.users.transactions', compact('user'));
    }
}
