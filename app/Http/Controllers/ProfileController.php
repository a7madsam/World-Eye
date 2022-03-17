<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Picture;
use App\Models\User;

class ProfileController extends Controller
{
    
    public function show($id){
        $user = User::where('id',$id)->first();
        return view('profile',['id'=>$id, 'picture'=>$user->picture, 'name'=>$user->name, 'email'=>$user->email, 'description'=>$user->description]);
    }

    public function edit(Request $request){
        if ($request->hasFile('file')) {
            $imagePath = $request->file('file');
            $imageName = $imagePath->getClientOriginalName();
            $destinationPath = public_path('/image');
            $imagePath->move($destinationPath, sha1($imageName));
            Auth::user()->picture = sha1($imageName);
            Auth::user()->save();
        }
        if(!empty($request->description))
            Auth::user()->description = $request->description;
        else
            Auth::user()->description = " ";
        Auth::user()->name = $request->name;
        Auth::user()->save();

        return response()->json(['success'=>true]);
    }

    public function add(Request $request){
        if ($request->hasFile('file')) {
            $imagePath = $request->file('file');
            $imageName = $imagePath->getClientOriginalName();
            $destinationPath = public_path('/image');
            $imagePath->move($destinationPath, sha1($imageName));
            if(!Picture::where('name',$imageName)->where('userID',Auth::user()->id)->exists()){
                $picture = new Picture();
                $picture->name = sha1($imageName);
                $picture->userID = Auth::user()->id;
                $picture->visable = '0';
                $picture->save();
            }
        }
        return response()->json(['success'=>true]);
    }
    
}
