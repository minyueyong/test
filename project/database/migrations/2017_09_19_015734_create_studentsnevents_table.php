<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsneventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentsnevents', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('studentid')->unsigned();
            $table->foreign('studentid')
            ->references('studentid')->on('students')
            ->onDelete('cascade');
            $table->integer('eventid')->unsigned();
            $table->foreign('eventid')
            ->references('eventid')->on('events')
            ->onDelete('cascade');
            $table->integer('participate')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studentsnevents');
    }
}
