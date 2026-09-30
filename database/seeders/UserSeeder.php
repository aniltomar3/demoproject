<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json= File::get('database/json/user.json');
        $users= collect(json_decode($json));

         $users->each(function($record){
            User::create([
               'name'=>$record->name,
               'email'=>$record->email,
               'password'=>$record->password,
               'image'=>'' 
            ]);
         });
    }
}
