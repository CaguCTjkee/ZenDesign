<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login()
    {
        // validate
        $rules = array(
            'password' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if( $validator->fails() )
        {
            return Redirect::to('admin')->withErrors($validator)->withInput();
        }
        else
        {
            if( config('login.pass') === Input::get('password') )
            {
                Session::put('is_admin', true);
            }
            else
                return Redirect::to('admin')->withErrors(['Fail password'])->withInput();
        }

        return redirect('/');
    }

    public function logout()
    {
        return redirect('/');
    }

    static function isAdmin()
    {
        if( Session::get('is_admin') === true )
            return true;

        return false;
    }

    static function checkAuth()
    {
        if( self::isAdmin() === true )
            return true;

        abort(404, 'This action is unauthorized.');
    }
}
