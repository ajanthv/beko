<?php

use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

// Landing page route
Route::get('/', function(){
    return view('welcome');
});

// Authentication routes...
Route::group(['middleware' => ['web']], function () {
    Route::get('/admin', 'Auth\AuthController@getLogin');
    Route::post('/admin/authenticate', 'Auth\AuthController@postLogin');
});

// Authentication routes...
Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin/create-promotion', 'PromotionController@index');
    Route::get('/admin/get-cards', 'PromotionController@getCards');
    Route::post('/admin/promotion', 'PromotionController@postCreate');
});
Route::get('/get-promotions', 'PromotionController@getPromotions');


Route::post('auth/login-action', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('/admin', 'Auth\AuthController@getLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

//// Registration routes...
//Route::post('auth/register-action', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@postRegister']);
//Route::get('auth/register', ['as' => 'auth.register_form', 'uses' => 'Auth\AuthController@getRegister']);

//// Password reset routes...
//Route::post('auth/reset', ['as' => 'auth.reset', 'uses' => 'Auth\AuthController@postResetPassword']);
//Route::get('auth/resetVerify', 'Auth\AuthController@getResetPasswordVerify');
//Route::post('auth/resetVerify', 'Auth\AuthController@postResetPasswordComplete');
//Route::get('auth/activation-message', 'Auth\AuthController@getActivateMessage');

//// activate user
//Route::get('activate/{id}/{code}', function ($id, $code) {
//    $user = Sentinel::findById($id);
//
//    if (!Activation::complete($user, $code)) {
//        return redirect()
//            ->intended("auth/login")
//            ->withErrors(trans('messages.invalid_activation_code'));
//    }
//    
//    return redirect()
//        ->intended('auth/login')
//        ->withSuccess(trans('messages.account_activated'));
//
//})->where('id', '\d+');

//// reactivate user
//Route::get('reactivate', function () {
//    if (! $user = Sentinel::check()) {
//        return redirect()
//            ->intended('auth/login')
//            ->withErrors(trans('messages.flash_notification_acc_not_active'))
//            ;
//
//    }
//    $activation = Activation::exists($user) ?: Activation::create($user);
//
//    Activation::complete($user, $activation->code);
//
//    return redirect()
//        ->intended('user')
//        ->withSuccess(trans('messages.account_activated'));
//
//})->where('id', '\d+');
//
//// TODO : These routes can be set or remove base on the project
//// Route for issue oauth token
//Route::post('oauth/access_token', 'Auth\OauthClientAuthorizationController@accessToken');
//Route::post('oauth/forget-password', 'Auth\OauthClientAuthorizationController@forgotPassword');
//
//$api = app('Dingo\Api\Routing\Router');
//
//$api->version('v1', function ($api) {
//
//        // authenticated routes
//        $api->group(['middleware' => 'api.auth'], function ($api) {
//
//			// TODO : API routes that are required authentication
//            //$api->controller('profile', 'App\Http\Controllers\API\ProfileController');
//
//        });
//
//    // unauthenticated routes
//
//});