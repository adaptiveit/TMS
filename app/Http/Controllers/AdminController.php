<?php

namespace App\Http\Controllers;

//use Pingpong\Modules\Routing\Controller;
use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
//use Modules\Admin\Models\User;
use App\Models\User;

class AdminController extends Controller {

    public function __construct() {
        if (Auth::check()){
            return redirect('admin/dashboard')->send();
        }
    }

    public function index() {
        $title = "Dashboard";
        return redirect('admin/dashboard');
    }

    public function getLogin() {
        $title = "Login";
		//return view('admin::login', compact('title'));
		return view('login', compact('title'));
    }

    public function login(Request $request) {
        $field = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';
        $request->merge([$field => $request->input('login')]);
        
        #$credentials = $request->only(['login', 'password']);
        $credentials = $request->only($field, 'password');
        $credentials = array_merge($credentials, ["status" => 1]); //allow login only active users

        #dd($credentials);
    
        $remember = $request->get('remember') ? true : false;

        $validator = Validator::make($credentials, [
                    $field => 'required',
                    'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->all();
            return redirect('admin/login')->withErrors($validator)->withInput();
        } else {
            if (Auth::attempt($credentials, $remember)) {
                return redirect()->intended('admin/dashboard');
            } else {
                $user = new User();
                $user = $user->where($field, '=', $credentials[$field])->get()->first();
                //dd($user);
                if(is_array($user) && count($user) && $user->status != 1) {
                    return redirect('admin/login')->withErrors('User is not active.');
                } else {
                    return redirect('admin/login')->withErrors('Invalid credentials or user not exist.');
                }
            }
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('admin/login');
    }

}
