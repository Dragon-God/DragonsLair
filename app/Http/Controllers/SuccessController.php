<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuccessController extends Controller
{
    public function index($successCode = '')
    {
        return view('misc.success')->with('successCode', $successCode);
    }
    public function postSuccess()
    {
        return $this->index('postSuccess');
    }
    public function registrationSuccess()
    {
        return $this->index('registrationSuccess');
    }
}
