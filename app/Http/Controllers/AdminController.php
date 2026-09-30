<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use App\Mail\Welcomeemail;
use App\Mail\Secondemail;


class AdminController extends Controller
{
  public function register(request $request){
     $data= $request->validate([
        'fname'  =>'required',
        'fmail' =>'required|email',
        'fpass'=>'required|confirmed',
        'photo'=>'required|mimes:jpg,jpeg,png|max:2048'
     ]);
     $photo = $request->file('photo');
     $photo_name= time() . '_' . $photo->getClientOriginalName();
     $photo->move(public_path('image'),$photo_name);
     $userData=[
      'name' =>$request->fname,
      'email'=>$request->fmail,
      'password'=>$request->fpass,
      'image'=>$photo_name
     ];
     $user= User::create($userData);
    if($user){
     // sending email attachment
     $adminEmail= 'aniltomar3@gmail.com';
     $subject= "Welcome email";
     $message= "New User registered successfully";
     $response= Mail::to($adminEmail)->send(new Secondemail($subject,$message,$photo_name)); 
      if($response){
          return redirect()->route('login')->with('success','Registration done successfully'); 
      }
    } 

  }

  public function logincheck(request $request){
     $credentials= $request->validate([
       'email'  =>'required|email',
       'password'=>'required'
     ]);
     if(Auth::attempt($credentials)){
      session()->put(['name'=>'demo']);
      session()->increment('count');
      session()->flash('status','Session value saved successfully');
      return redirect()->route('dashboard');
     }else{
      return redirect()->route('login')->withErrors(['email'=>'Email or password not match']);
    }
  }

  public function dashboard(){
   // if(Auth::check()){
   //    return view('auth.dashboard');
   //   }else{
   //    return redirect()->route('login')->withErrors(['email'=>'Unauthorise attemp for login']);;
   //   }
   //$value= session()->all();
   //echo "<pre>"; print_r($value);

  //  if(Gate::allows('isAdmin')){
  //    return "Hello how are you admin";
  //  }else{
  //   abort(403);
  //  }
   //Gate::authorize('isAdmin'); // check in Appserviceprovider file if false return 404 page
   return view('auth.dashboard');
  }

  public function logout(){
    Auth::logout();
    //session()->forget(['name','count']);
    // session()->flush();
    session()->invalidate();  // Regenerate session "_token" and removes all session
    return redirect()->route('login');
  }

  public function sendEmail(){
          $toEmail= 'websoftonictutors@gmail.com';
          $subject= "Welcome email";
          $message= "Hello, Welcome to our website";
          $details=['product_name'=>'test product','price'=>100];
      $output= Mail::to($toEmail)->send(new Welcomeemail($subject,$message,$details));  
     // dd($output);  
  }
 
}
