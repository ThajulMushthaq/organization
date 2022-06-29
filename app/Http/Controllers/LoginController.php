<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //


    public function register()
    {
        return view('login.register');
    }


    public function register_user(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'password_confirmation' => 'required|same:password'
        ]);
        $values = ([
            'name' => $request->get('name') ?: '',
            'email' => $request->get('email') ?: '',
            'phone' => $request->get('phone') ?: '',
            'password' => Hash::make($request->get('password')),
            'address' => $request->get('address') ?: null,
            'dob' => $request->get('dob') ?: null,
            'gender' => $request->get('gender') ?: '',
            'type' => $request->get('type') ?: '',
        ]);
        if(request()->image){
            $filename = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $filename);
            $values['image'] = $filename;
        }
        // dd($values,$filename);

        $user = User::create($values);
        auth()->login($user);

        return redirect('/home')->with('success', "Account successfully registered.");
    }
    public function login()
    {
        return view('login.login');
    }

    public function validate_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        // dd($credentials);
        if (!Auth::validate($credentials)) :
            return redirect()->to('/')->with("error", "Wrong credentials..!");
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }



    public function do_logout()
    {
        Session::flush();

        Auth::logout();

        return redirect('/');
    }
}
