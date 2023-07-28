<?php

namespace App\Http\Controllers;

use App\Models\Epin;
use Illuminate\Http\Request;

class EpinController extends Controller
{
    function buyEpin()
    {
        return Epin::all();
    }
}
