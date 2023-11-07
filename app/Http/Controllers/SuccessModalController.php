<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuccessModalController extends Controller
{
    public function index()
    {
        return view('modals.success');
    }
}
