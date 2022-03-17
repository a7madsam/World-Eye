<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\User;

class LoginController extends Controller
{
    public function show(Request $request){
        return view('login');
    }

    public function check(Request $request){
        if(User::where('username', $request->username)->where('password',$request->password)->exists()){
            $user = User::where('username', $request->username)->where('password',$request->password)->first();
            $request->session()->put('name', $user->name);
            $request->session()->put('username', $user->username);
            $request->session()->put('description', $user->description);
            $request->session()->put('description', $user->description);
            return response()->json(['success' => true, 'message' => 'exists']);
        }
        else if(User::where('username', $request->username)->exists()){
            return response()->json(['success' => true, 'message' => 'password not correct']);
        }
        else{
            return response()->json(['success' => true, 'message' => 'Not exist']);
        }
    }
}
