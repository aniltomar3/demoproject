<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class Usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
      // $data= Student::find(2,['name','address']);
       //$data= Student::count();
       // $data= Student::where('city','up')->orWhere('city','delhi')->get();  //->ddRawSql();
       //whereNot('city','delhi')->wherenIn('age',[20,22])
       //return $data;

        $data= Student::paginate(20);
        return view('eloquent.student',['data'=>$data]);
        // foreach($data as $val){
        //     echo $val->name."<br/>";
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('eloquent.adduser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'username'=>'required|string',
        'useremail'=>'required|email',
        'usercity'=>'required|alpha',
        'useraddress'=>'required',
       ],[
        'username.required'=>'User name11 is required!'
       ]);
     $student= new Student;
     $student->name=      $request->username;
     $student->address=   $request->useremail;
     $student->stu_email= $request->usercity;
     $student->city=      $request->useraddress;
      $student->save();

     // Student::create([],[]);  // for multiple records first in mode $guarded=[];
      return redirect()->route('student.index')->with('status','Student name added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student= Student::find($id);
       // return $student;
        return view('eloquent.edit',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student= Student::find($id);
        $student->name=      $request->username;
        $student->address=   $request->useremail;
        $student->stu_email= $request->useraddress;
        $student->city=      $request->usercity; 
      $student->save();
      // Student::where('id',$id)->update([],[]);
      return redirect()->route('student.index')->with('status','Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       //Student::destroy([2,5,7]); 
       $student= Student::find($id);
       $student->delete();

       return redirect()->route('student.index')->with('status','Data Deleted successfully');
    }
}
