<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;

class HomeController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }
}
