<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Request;
use App\Http\Requests\ResetRequest;
use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

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
		// TODO : login form
        // return view('login');
    }

    /**
     * Verify user and log into the system.
     *
     * @param LoginRequest $request
     * @internal param array $data
     */
    protected function postLogin(LoginRequest $request)
    {
		// TODO : user login process
        try {
            $errors = [];

            $remember = (bool) $request->get('remember', false);

            $credentials = [
                'email' => $request->get('email'),
                'password' => $request->get('password')
            ];

            if (Sentinel::authenticate($credentials, $remember))
            {
                return redirect()
                    ->intended('/');
            }

            $errors[] = trans('messages.flash_notification_login_failed');

        }
        catch (NotActivatedException $e)
        {
            return redirect()
                ->intended('reactivate')
                ->with('user', $e->getUser());
        }
        catch (ThrottlingException $e)
        {
            $delay = $e->getDelay();

            $errors[] = trans('messages.flash_notification_wait', ['delay' => $delay]);
        }

        return redirect()
            ->intended('auth/login')->withErrors($errors);

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
     * Create a new user instance after a valid registration.
     *
     * @param RegisterRequest $request
     * @internal param array $data
     */
    public function postRegister(RegisterRequest $request)
    {
		// TODO : User registration process
		if ($user = Sentinel::register($request->all()))
		{
			return Redirect::home()->withSuccess('Registration complete.');
		}

		return Redirect::back()->withInput()->withErrors('An error occured while registering.');
    }

    /**
     * Logging out current user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        Sentinel::logout(null, true);
        return redirect()->intended();
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
        $user = Sentinel::findByCredentials(['login' => $request->email]);

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
        }

    }

    /**
     * Show password reset form to enter new password
     *
     * @return Redirect
     */
    public function getResetPasswordVerify()
    {
		// TODO : Reset password form with code verification
        $user = Sentinel::findById(Input::get('id'));

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
        }

    }

    /**
     * Redirect user to login after setting up new password
     *
     * @return mixed
     */
    public function postResetPasswordComplete()
    {
		// TODO : Password reset process
        $password = Input::get('password');

        $passwordConf = Input::get('password_confirmation');

        $user = Sentinel::findById(Input::get('id'));

        $reminder = Reminder::exists($user, Input::get('code'));

        // incorrect info was passed.
        if ($reminder == false)
        {
            return redirect()
                ->intended('auth/login')->withErrors(trans('messages.password_reset_failed'))
                ;
        }

        if ($password != $passwordConf)
        {
            return view('reset.complete')
                ->with('id', Input::get('id'))
                ->with('code', Input::get('code'))
                ->withErrors(trans('messages.password_reset_match_password'))
                ;

        }

        Reminder::complete($user, Input::get('code'), $password);

        return redirect()->intended('auth/login')->withSuccess(trans('messages.password_reset_complete'));
    }
}
