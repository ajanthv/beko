<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Input;

class OauthClientAuthorizationController extends Controller
{

    private $userRepo;

    /**
     * OauthClientAuthorizationController constructor.
     * @param UserRepositoryInterface $userRepo
     */
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function accessToken(){
        $userdata = Input::all();

        $input = array(
            'client_id' => env('API_CLIENT_ID', ''),
            'client_secret' => env('API_CLIENT_SECRET', ''),
            'grant_type' => env('API_GRANT_TYPE', ''),
            'username' => $userdata['email'],
            'password' => $userdata['password']
        );

        try{
            $request = \Request::instance();
            $request->request->replace($input);
            Authorizer::setRequest($request);
            return \Response::json(Authorizer::issueAccessToken());
        } catch(\Exception $e){
            throw $e;
        }
    }

    
}
