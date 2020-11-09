<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Statistik;

class StatistikController extends Controller
{
    public function users()
    {
        $user = User::count();
    }
}