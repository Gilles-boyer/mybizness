<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
    /**
     * display view app
     * @return view
     */
    public function index()
    {
        return view('app');
    }
}
