<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function landingpage() {
        return view('welcome');
    }

    public function dashboard() {
        return view('dashboard');
    }

    public function buttons() {
        return view('buttons');
    }

    public function cards() {
        return view('cards');
    }
}
