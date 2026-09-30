<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\File;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

      $json= File::get('database/json/students.json');
      $students= collect(json_decode($json));
      $students->each(function($record){
        Student::create([
            'name'=> $record->name,
            'address'=> $record->address,
            'stu_email'=> $record->stu_email,
            'city'=> $record->city,
        ]);
     });

    //    Student::create([
    //     'name'=>'Demo Name',
    //     'address'=>'Demo address',
    //     'stu_email'=>'demo@gmail.com',
    //     'city'=>'Delhi'
    //    ]);

    //  $students= collect([
    //     [
    //       'name'=>'Demo Name1',
    //       'address'=>'Demo1 address',
    //       'stu_email'=>'demo1@gmail.com',
    //       'city'=>'MP'
    //     ],
    //     [
    //       'name'=>'Demo Name2',
    //       'address'=>'Demo address2',
    //       'stu_email'=>'demo2@gmail.com',
    //       'city'=>'UP'
    //     ],
    //  ]);

    //  $students->each(function($record){
    //     Student::insert($record);
    //  });

    }
}
