<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Library;


class LibraryController extends Controller
{
    public function showlibData(){
       // $lib= Library::with('student')->get();
       $lib= Library::withWhereHas('student',function($query){
         $query->where('city','=','delhi')->orWhere('city','=','MP');
       })->get();
        return $lib;
    }
}
