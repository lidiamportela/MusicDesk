<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilController extends Controller
{
    public function loadWelcome() {
    return view('welcome');
    }
}
