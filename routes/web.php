<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LibraryController;
use App\Http\Middleware\ValidUser;
use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Mail;
use App\Mail\Websitemail;
use App\Jobs\EmailSendingJob;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test',function(){
   return view('test');
});

Route::get('/home', function () {
    return view('pages.home');
})->name('home');

Route::get('/post/{id?}', function($id=null){
    //return view('post');
    if($id){
      echo "<h1> POST ID: ".$id."</h1>";
    }else{
        //echo "<h1> No Post ID found </h1>";
        return view('post');
    }
})->where('id','[0-9]+')->name('mypost');     //whereNumber  //whereAlphaNumeric  // whereAlpha

//Route::view('/abouts','about');
Route::get('/abouts',function(){
 return view('about');
})->name('about');



Route::get('/users',function(){
    $name= 'testing';
    return view('pages.users',['user'=>$name,'city'=>'']);
   //return view('pages.users')->with('user',$name)->with('city','Delhi');
  // return view('pages.users')->withUser($name)->withCity('Delhi');
});

Route::get('/demopage',[PageController::class,'showUser']);


// student routes
Route::get('/stuadd',[StudentController::class,'addUser']);
Route::get('/stushow',[StudentController::class,'showUsers']);
Route::get('/stujoinshow',[StudentController::class,'showUsersBook']);
Route::get('/stuwhen',[StudentController::class,'whenData']);
Route::get('/stuchunk',[StudentController::class,'chunk']);
Route::get('/stushowsingle/{id}',[StudentController::class,'showSingleUsers'])->name('stu.singleuser');
Route::get('/stupdate/{id}',[StudentController::class,'updateUser']);
Route::get('studelete/{id}',[StudentController::class,'deleteUser']);
Route::get('studeleteAll',[StudentController::class,'deleteAllUser']);

Route::get('/addstudent',function(){
    return view('pages.adduser');
});

Route::post('adduser',[StudentController::class,'adduserform'])->name('adduser');

// Resource controller
Route::resource('student',Usercontroller::class);

// Upload file
Route::get('imgform',[PageController::class,'imgform'])->name('imgform');
Route::post('/upload',[PageController::class,'upload'])->name('user.upload');

////////////////  Eloquent Relationship  ////////////////////////////
Route::get('/alldata',[StudentController::class,'allData']);
Route::get('/contactshow',[ContactController::class,'contactshow']);

Route::get('/showlibrarydata',[LibraryController::class,'showlibData']);
Route::get('/showdata',[StudentController::class,'showData']);

Route::fallback(function(){
   return "<h1> Page not found </h1>";
});


////////////////////////////// Login Authentication ///////////////////////////////////
Route::view('register','auth.registration')->name('register');
Route::view('login','auth.login')->name('login');
Route::post('registersave',[AdminController::class,'register'])->name('registersave');
Route::post('login',[AdminController::class,'logincheck'])->name('logincheck');
// isValidUser is an alias mentioned in bootstrap->app.php
// ->middleware("auth") inbuilt laravel middleware to check user login or not
Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard')->middleware('isValidUser:demo@gmail.com'); //->middleware('can:isAdmin'); //  //->middleware(ValidUser::class);
Route::get('logout',[AdminController::class,'logout'])->name('logout');
Route::get('send-email',[AdminController::class,'sendEmail']);


// Use middleware in group
// Route::middleware(['ok-user'])->group(function(){   });

//////////// AJAX API ////////////////////////////////
Route::get('ajaxform',function(){
    return view('ajax/login');
});

Route::get('allpost',function(){
    return view('ajax/posts');
});
Route::get('addpost',function(){
    return view('ajax/addPost');
})->name('addpost');



Route::get('/job',function(){
    $data['email'][0] ='depa240192@gmail.com';
    $data['email'][1] ='aniltomar3@gmail.com';
    $data['email'][2] ='depa240192@gmail.com';
  EmailSendingJob::dispatch($data,'testing','Demo testing mail sent!');  //->onQueue('emailing');
  return "Email job has been added to queue!";
});