<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Request;
use App\Http\Requests\ResetRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Login form interface
     */
    public function getLogin()
    {
        return view('admin.login');
    }

    /**
     * Verify user and log into the system.
     * @param LoginRequest $request
     * @return Redirect
     */
    protected function postLogin(LoginRequest $request)
    {
        $data = Input::get();
        $response = DB::table('users')->where('email', $data['email'])->first();
        if (isset($response->id)) {
            if ($response->password == sha1($data['password'])) {
                return redirect('/admin/create-promotion');
            } else {
                $request->session()->flash('message', 'Incorrect Password!');
                return redirect('/admin');
            }
        } else {
            $request->session()->flash('message', 'Incorrect Email!');
                return redirect('/admin');
        }
    }

    /**
     * Register form interface
     */
    public function getRegister()
    {
        // TODO : User registration form
        // return view('register');
    }

 

 

    /**
     * Show password reset email form to the user
     *
     * @return mixed
     */
    public function getResetPassword()
    {
        // TODO : Password reset form
        //return view('reset.reset');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getActivateMessage()
    {
        // TODO : Activation sent notify page
        //return view('web.activation-email-message');
    }

    /**
     * Send reset email to the user
     *
     * @param ResetRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postResetPassword(ResetRequest $request)
    {
		// TODO : Reset password process
        /*$user = Sentinel::findByCredentials(['login' => $request->email]);

        if ($user)
        {
            ($reminder = Reminder::exists($user)) || ($reminder = Reminder::create($user));

            $sent = Mail::queue('reset.reminder', ['reminder' => $reminder], function ($message) use ($user)
            {

                $message
                    ->to($user->email, $user->first_name . ' ' . $user->last_name)
                    ->subject(trans('messages.password_reset_subject'));

            });

            return response()->json([

                'status' => true ,
                'messages' => [trans('messages.reset_email_sent')]

            ]);
        }
        else
        {
            return response()->json(['errors' => [trans('messages.reset_email_invalid')]], 422);
        }*/

    }

    /**
     * Show password reset form to enter new password
     *
     * @return Redirect
     */
    public function getResetPasswordVerify()
    {
		// TODO : Reset password form with code verification
        /*$user = Sentinel::findById(Input::get('id'));

        if (Reminder::exists($user, Input::get('code')))
        {
            return view('reset.complete')
                ->with('id', Input::get('id'))
                ->with('code', Input::get('code'))
                ;
        }
        else
        {
            //incorrect info was passed
            return redirect();
        }*/

    }

    /**
     * Redirect user to login after setting up new password
     *
     * @return mixed
     */
    public function postResetPasswordComplete()
    {
		// TODO : Password reset process
        
    }
}
