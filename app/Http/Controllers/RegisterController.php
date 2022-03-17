<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class RegisterController extends Controller
{
    public function add(Request $request){
        if(User::where('username',$request->username)->exists()){
            return response()->json(['success' => true, 'message' => 'exists']);
        }
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->save();
        return response()->json(['success' => true, 'message' => 'Not exists']);
    }
}
