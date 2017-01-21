<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PromotionController extends Controller
{

    public function __construct()
    {
    }
    
    public function index()
    {
        return view('admin.createPromotion');
    }
}
