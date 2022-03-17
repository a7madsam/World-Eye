<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Picture;
use App\Models\User;
use App\Models\UserSavePicture;
use App\Models\Comment;
use App\Models\UserLikePicture;
use App\Models\Notefication;

class PictureController extends Controller
{

    public function privacy(Request $request){
        $picture = Picture::where('name', $request->name)->first();

        if($picture->visable == 1)
            $picture->visable = 0;
        else 
            $picture->visable = 1;
        $picture->save();

        return response()->json(['sucess'=>true]);
    }
    public function deleteComment(Request $request){
        $picture = Picture::where('name', $request->name)->first();
        Comment::where('content',$request->content)->where('pictureID', $picture->id)->where('userID', Auth::user()->id)->delete();
        return response()->json(['sucess'=>true]);
    }

    public function add(Request $request){
        $picture = Picture::where('name', $request->name)->first();
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->pictureID = $picture->id;
        $comment->userID = Auth::user()->id;
        $comment->save();

        $notefication = new Notefication();
        $notefication->userID = Auth::user()->id;
        $notefication->pictureID = $picture->id;
        $notefication->visited = 0;
        $notefication->commentID = $comment->id;
        $notefication->type = 0; //comment
        $notefication->save();

        return response()->json(['sucess'=>true]);
    }

    public function picture(Request $request){
        $picture = Picture::where('name', $request->name)->first();
        $userPicture = User::where('id', $picture->userID)->first();
        $comment = Comment::all()->where('pictureID', $picture->id);
        $temp = array();
        foreach ($comment as $row) {
            $column = User::where('id', $row->userID)->first();
            $isUser = ($column->email == Auth::user()->email);
            $new = array();
            array_push($new,$column->name, $row->content, $column->picture, $isUser);
            array_push($temp, $new);
        }
        return response()->json(['success'=> true, "comment" => $temp, "userPicture" => $userPicture]);
    }

    public function view(Request $request){
        $picture = Picture::where('name', $request->name)->first();
        $user = User::where('id',$picture->userID)->first();
        $comment = Comment::all()->where('pictureID', $picture->id);
        $temp = array();

        foreach ($comment as $row) {
            $column = User::where('id',$row->userID)->first();
            $new = array();
            array_push($new,$column->name, $row->content);
            array_push($temp, $new);
        }
        return response()->json(['success' => true,'shareNumber' => $picture->shareNumber,'reactNumber' => $picture->reactNumber,'user' => $user->name, 'comment' => $temp]);
    }

    public function trash(Request $request) {
        $pictures = Picture::where('name', $request->name)->first();
        if(UserSavePicture::where('userID',Auth::user()->id)->where('pictureID', $pictures->id)->exists()) {
            UserSavePicture::where('userID',Auth::user()->id)->where('pictureID', $pictures->id)->delete();
        }
        else {
            $pictures = Picture::where('name', $request->name)->delete();
        }

        return response()->json(['success' => true]);
    }

    public function getAllPicture(Request $request) {
        $pictures = Picture::all()->where('userID','!=',Auth::user()->id)->where('visable', 1);
        $temp = array();
        foreach ($pictures as $row) {
            $isLiked = UserLikePicture::where('userID', Auth::user()->id)->where('pictureID', $row->id)->exists();
            $isSaved = UserSavePicture::where('userID', Auth::user()->id)->where('pictureID', $row->id)->exists();
            $new = array();
            array_push($new,$row->name, $row->reactNumber, $row->shareNumber , $isLiked, $isSaved);
            array_push($temp, $new);
        }
        return response()->json(['success' => true, 'message' => $temp]);
    }

    public function getMyPictureUser(Request $request) {
        $pictures = Picture::all()->where('userID', $request->id);
        $temp = array();
        foreach ($pictures as $row) {
            $isLiked = UserLikePicture::where('userID', Auth::user()->id)->where('pictureID', $row->id)->exists();
            $isSaved = UserSavePicture::where('userID', Auth::user()->id)->where('pictureID', $row->id)->exists();
            $new = array();
            if($row->visable == 0)
                array_push($new,$row->name, $row->reactNumber, $row->shareNumber, $isLiked, $isSaved, 'green');
            else 
                array_push($new,$row->name, $row->reactNumber, $row->shareNumber, $isLiked, $isSaved, 'inherit');
            array_push($temp, $new);
        }
        return response()->json(['success' => true, 'message' => $temp]);
    } 

    public function save(Request $request){
        $picture = Picture::where('name', $request->name)->first();
        if(!UserSavePicture::where('pictureID', $picture->id)->where('userID',Auth::user()->id)->exists()){
            $new = new UserSavePicture();
            $new->userID = Auth::user()->id;
            $new->pictureID = $picture->id;
            $new->save();
            $picture->shareNumber += 1;
            $picture->save();

            $notefication = new Notefication();
            $notefication->userID = Auth::user()->id;
            $notefication->pictureID = $picture->id;
            $notefication->visited = 0;
            $notefication->commentID = 1;
            $notefication->type = 1; //share
            $notefication->save();
        }
        else{
            $picture->shareNumber -= 1;
            $picture->save();

            $notefication = new Notefication();
            $notefication->userID = Auth::user()->id;
            $notefication->pictureID = $picture->id;
            $notefication->visited = 0;
            $notefication->commentID = -1;
            $notefication->type = 1; //share
            $notefication->save();

            UserSavePicture::where('pictureID', $picture->id)->where('userID',Auth::user()->id)->delete();
        }
        return response()->json(['success' => true]);
    }

    public function closeNotefication(Request $request){
        $note = Notefication::where('id', $request->id)->first();
        $note->visited = 1;
        $note->save();
        return response()->json(['success' => true]);
    }

    public function notefication(Request $request){
        $Notefication = Notefication::all();
        $temp = array();
        foreach ($Notefication as $column) {
            $row = Picture::where('id', $column->pictureID)->first();
            if($row->userID == Auth::user()->id && $row->userID != $column->userID){
                $user = User::where('id',$column->userID)->first();
                $content = '-2';
                if($column->type == 0){
                    $cont = Comment::where('id',$column->commentID)->first();
                    $content = $cont->content;
                }
                $new = array();
                array_push($new,$row->name, $user->name, $column->visited, $column->type, $content, $column->commentID, $column->id, $user->picture);
                array_push($temp, $new);
            }
        }
        return response()->json(['success' => true, 'message' => $temp]);
    }

    public function like(Request $request){
        $picture = Picture::where('name', $request->name)->first();
        if(!UserLikePicture::where('pictureID', $picture->id)->where('userID',Auth::user()->id)->exists()){
            $new = new UserLikePicture();
            $new->userID = Auth::user()->id;
            $new->pictureID = $picture->id;
            $new->save();
            $picture->reactNumber += 1;
            $picture->save();

            $notefication = new Notefication();
            $notefication->userID = Auth::user()->id;
            $notefication->pictureID = $picture->id;
            $notefication->visited = 0;
            $notefication->commentID = 1;
            $notefication->type = 2; //like
            $notefication->save();
        }
        else{
            $picture->reactNumber -= 1;
            $picture->save();
            $notefication = new Notefication();
            $notefication->userID = Auth::user()->id;
            $notefication->pictureID = $picture->id;
            $notefication->visited = 0;
            $notefication->commentID = -1;
            $notefication->type = 2; //share
            $notefication->save();
            UserLikePicture::where('pictureID', $picture->id)->where('userID',Auth::user()->id)->delete();
        }
        return response()->json(['success' => true]);
    }

    public function getSavedPictureUser(Request $request) {
        $pictures = UserSavePicture::all()->where('userID',Auth::user()->id);
        $temp = array();
        foreach ($pictures as $column) {
            $row = Picture::where('id', $column->pictureID)->first();
            $new = array();
            array_push($new,$row->name, $row->reactNumber, $row->shareNumber);
            array_push($temp, $new);
        }
        return response()->json(['success' => true, 'message' => $temp]);
    }
}
