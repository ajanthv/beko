<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class PromotionController extends Controller
{

    public function __construct()
    {
    }
    
    public function index()
    {
        $banks = DB::table('banks')->lists('name', 'id');

        return view('admin.createPromotion')->with('banks', $banks);
    }

    public function getCards() {
        $data = Input::all();
        $bankId = $data['bankId'];
        $cards = DB::table('creditcards')->where('bank_id', $bankId)->lists('name', 'id');

        $view = view('admin.partials.cardList', compact('cards'))->render();
        return response()->json(['success' =>'true','view'=>$view]);
    }
}
