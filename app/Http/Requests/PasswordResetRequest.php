<?php
/**
 * @file PasswordResetRequest.php.
  * @class PasswordResetRequest.
  * @date 11/3/2015 10:35 AM
 * @author Vinodhan Rajarathnam <vinodhan.r@eyepax.com>
 * @copyright Copyright (c) Eyepax IT Consulting (Pvt) Ltd.
 */

namespace App\Http\Requests;


class PasswordResetRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ];
    }
}
