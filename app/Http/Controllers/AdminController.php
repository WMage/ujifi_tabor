<?php

namespace App\Http\Controllers;

use App\Models\Szerepkor;
use App\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /** @var User $user */
        $user=auth()->user();
        return $user->getOsszesJog();
        dd($user->jelentkezo->szerepkor->jogok);
        return view('home');
    }
}
