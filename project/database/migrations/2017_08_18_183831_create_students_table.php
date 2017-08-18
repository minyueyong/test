<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('firstName');
            $table->string('lastName');
            $table->date('dob');
            $table->integer('phone');
            $table->string('campus');
            $table->string('gender');
            $table->string('education');
            $table->string('interest');
            $table->string('image');
            $table->string('aboutme');
            $table->integer('userid')->unsigned();
            $table->foreign('userid')
            ->references('id')->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
