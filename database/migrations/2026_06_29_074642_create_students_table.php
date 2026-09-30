<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
           $table->id();
           $table->string('name');
           $table->string('email')->unique()->nullable();
           $table->string('city',20)->default('no city');
          // $table->primary('stu_id');
           // ->nullable()   // ->unique()   // ->unique('email')
           // $table->foreign('user_id')->references('id)->('user')
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
