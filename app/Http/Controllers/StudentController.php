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


}

