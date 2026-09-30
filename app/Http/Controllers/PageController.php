<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showUser(){
        return "<h1> Welcome to page controller </h1>";
    }

    public function imgform(){
      return view('upload');
    } 

    public function upload(Request $request){
       $file= $request->file('photo');
       $request->validate([
        'photo'=>'required|mimes:png,jpg,jpeg|max:3000'
       ]);
       $fileName= time().'_'.$file->getClientOriginalName();
       $path= $request->photo->storeAs('image',$fileName,'public');
      // return $path;
       return redirect()->route('imgform')->with('status','User image uploaded successfully');
    }
}
