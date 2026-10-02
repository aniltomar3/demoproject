<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
use App\Rules\Uppercase;
use App\Models\Student;
use App\Models\Contact;
use App\Models\Library;

class StudentController extends Controller
{

   public function addUser(){
    // insert    //insertorIgnore - ignore duplicate records    //upsert - insert and update data
    // insertGetId
    $user=  DB::table('students')->insertGetId(
        [
            'name'=>'Ronaldo',
            'address'=>'demo address',
            'stu_email'=>'ronaldo@gmail.com',
            'city'=>'Noida'
        ]     //,['stu_email'],['city']
       );
       echo $user;
    //if($user){ echo "<h1>Data successfully added</h1>"; }else{ echo "<h1>Data not added</h1>"; }   
   }

   public function updateUser($id){
    // updateorInsert(['match value'],[data need to update'])
      $user= DB::table('students')
      ->where('id',$id)
      ->update(['address'=>'test address','city'=>'up']);
      if($user){ echo "<h1>Data successfully updated</h1>"; }else{ echo "<h1>Data not updated</h1>"; }   
   }

   public function deleteUser($id){
    $user= DB::table('students')->where('id',$id)->delete();
    if($user){ echo "<h1>Data successfully Deleted</h1>"; }else{ echo "<h1>Data not deleted</h1>"; }   
   }

   public function deleteAllUser(){
    $user= DB::table('students')->truncate();
    // not work due to libraries foreign key dependency
   } 

  public function showUsers(){
    // where('city','goa')   // where('name','like','a%')
    // whereBetween('id',[3,6])  whereIn('city',['Delhi','Goa'])
     $users= DB::table('students')->paginate(4,['*'],'p')->fragment('user');  //->simplePaginate(5);
     //paginate(no of pages,[column name],querystring name)->appends(['sort'=>'votes])
     //return $users;
     return view('student',['data'=>$users]);
  }

  public function showSingleUsers($id){
    $users= DB::table('students')->where('id',$id)->get();
    return $users;
  }

  public function showUsersBook(){
        // $data= DB::table('students') //->select('students.*','libraries.book')
        // ->join('libraries','students.id','=','libraries.student_id')
        // ->select(DB::raw('count(*) as student_count'),'libraries.book')->groupBy('libraries.book')->get();
        // return $data;

    //left join    
       $data= DB::table('students')
       ->leftJoin('libraries',function(JoinClause $join){
           $join->on('students.id','=','libraries.student_id')->where('students.name','like','a%');
       })->get();
       return $data;    
  }

  public function whenData(){
    $data= DB::table('students')->when(false,function($query){
        $query->where('city','=','up');
    },function($query){ $query->where('city','=','delhi'); })->get();
    return $data;
  }

  public function chunk(){
    $data= DB::table('students')->orderBy('id')->chunkById(3,function($students){
       echo '<div style="border:1px solid red; margin-bottom:15px;">';
        foreach($students as $stu){ echo $stu->name . "<br/>"; }
       echo '</div>'; 
    });
  }

   public function adduserform(Request $req){
       $req->validate([
        'username'=>['required',new Uppercase],
        'useremail'=>'required|email',
        'usercity'=>'required',
        'useraddress'=>'required',
       ],[
        'username.required'=>'User name11 is required!'
       ]);
    return $req->all();   
  }

  

  /////////////////////////////////////////////////////////////////////
  // One to one realtionship
  //withWhereHas- filter data + return contact table data also
  // whereHas-  Filter data + no return contact table data
  public function allData(){
    $students= Student::where('city','delhi')->withWhereHas('contact',function($query){
      $query->where('gender','male');
    })->get();
     //echo $students->contact->phone."<br/>";
    return $students;
  }

  // One to many relationship
  public function showData(){
     // $data = Student::with('library')->find(3);
    //  $data = Student::doesnthave('library')->get();     // student dont have books in library
    //  $data = Student::has('library','>=',2)->with('library')->get(); // student have books with library data
    //  $data = Student::select('name','stu_email')->withCount('library')->having('library_count','>',1)->get();
    return $data;
  }


  //////////////////////////////////////////////////////////////
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

