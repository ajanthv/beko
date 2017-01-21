<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Storage;

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

        $image = $request->file('image');
//        $filename =  md5(date('Y-m-d H:i:s')). '.'.$image->getClientOriginalExtension();

        $imageName = $image->getClientOriginalName();
        $path = public_path(). '/uploads/promotions/';
        $image->move($path , $imageName);

        $data = Input::all();

        $this->userRepo->createPromotion($data, $image->getClientOriginalName());

        return redirect('/admin/create-promotion');
    }

    public function getPromotions() {
        
        $data = Input::all();
        
        $bankId = isset($data['bank_id']) ? $data['bank_id'] : 1;
        
        $promotions = $this->userRepo->getPromotions($bankId);

        $proms = [];
        foreach ($promotions as $promotion) {
            $cardIds = json_decode($promotion['creditcards']);
            $cards = DB::table('creditcards')->whereIn('id',$cardIds)->select('name', 'color')->get();
            $proms [] = [
                'description' => $promotion['description'],
                'title' => $promotion['title'],
                'cards' => $cards,
                'image' => $promotion['image']
            ];
        }
        $view = view('admin.partials.promotions', compact('proms'))->render();
        return response()->json(['success' =>'true','view'=>$view]);
    }

    public function getWelcome() {

        $banks = DB::table('banks')->select('id', 'name')->get();

        return view('welcome')->with('banks', $banks);

    }
}
