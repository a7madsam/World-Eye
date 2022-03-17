<?php
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware'=>['auth', 'verified']],function () {
    Route::post('/closeNotefication',[PictureController::class, 'closeNotefication'])->name('closeNotefication');
    Route::post('/notefication',[PictureController::class, 'notefication'])->name('notefication');
    Route::get('/notefication',[PictureController::class, 'notefication'])->name('notefication');
    Route::get('/profile/{id}',[ProfileController::class, 'show'])->name('profile');
    Route::post('/profile/{id}',[ProfileController::class, 'show'])->name('profile');
    Route::post('/updateImage',[ProfileController::class, 'edit'])->name('updateImage');
    Route::post('/addImage',[ProfileController::class, 'add'])->name('addImage');
    Route::post('/allPicture',[PictureController::class, 'getAllPicture'])->name('allPicture');
    Route::post('/save',[PictureController::class, 'save'])->name('save');
    Route::get('/save',[PictureController::class, 'save'])->name('save');
    Route::post('/savePictures',[PictureController::class, 'getSavedPictureUser'])->name('savePictures');
    Route::post('/getMyPictureUser',[PictureController::class, 'getMyPictureUser'])->name('getMyPictureUser');
    Route::get('/view',[PictureController::class, 'view'])->name('view');
    Route::post('/view',[PictureController::class, 'view'])->name('view');
    Route::post('/like',[PictureController::class, 'like'])->name('like');
    Route::get('/like',[PictureController::class, 'like'])->name('like');
    Route::post('/trash',[PictureController::class, 'trash'])->name('trash');
    Route::get('/trash',[PictureController::class, 'trash'])->name('trash');
    Route::get('/picture',[PictureController::class, 'picture'])->name('picture');
    Route::post('/picture',[PictureController::class, 'picture'])->name('picture');
    Route::get('/add',[PictureController::class, 'add'])->name('add');
    Route::post('/add',[PictureController::class, 'add'])->name('add');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/deleteComment', [PictureController::class, 'deleteComment'])->name('deleteComment');
    Route::get('/deleteComment', [PictureController::class, 'deleteComment'])->name('deleteComment');
    Route::post('/privacy',[PictureController::class, 'privacy'])->name('privacy');
});

Auth::routes(['verify' => true]);
Route::get('/', function(){
    return view('welcome');
});
