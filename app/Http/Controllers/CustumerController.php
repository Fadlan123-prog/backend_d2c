<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustumerController extends Controller
{
    public function index(){
        return view('cashier.view');
    }
}
