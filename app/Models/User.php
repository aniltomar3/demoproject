<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens ;

class User extends Authenticatable
{
    
    public $timestamps= false;
     use HasFactory,HasApiTokens ;
    protected $fillable= ['name','email','password','image'];
    protected $hidden=   ['password','remember_token'];

    protected function casts():array        //mutators
    {
        return[
            'password' => 'hashed',
        ];
    }

    public function posts(){
         return $this->hasMany(Post::class);
    }

    protected static function booted() : void{
          static::deleted(function($user){
              $user->posts()->delete();
          });
    }
}
