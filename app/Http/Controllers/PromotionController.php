<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Repositories\Contracts\UserRepositoryInterface;

class PromotionController extends Controller
{

    private $userRepo;

    public function __construct(
        UserRepositoryInterface $userRepo

    ) {
        $this->userRepo = $userRepo;
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

    public function postCreate(Request $request) {

        $data = Input::all();
        
        $this->userRepo->createPromotion($data);
    }
}
