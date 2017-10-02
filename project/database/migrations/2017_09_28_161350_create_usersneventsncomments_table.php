<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersneventsncommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usersneventsncomments', function (Blueprint $table) 
        {
            $table->increments('commentfid');
            $table->integer('userid')->unsigned();
            $table->foreign('userid')
            ->references('id')->on('users')
            ->onDelete('cascade');
            $table->integer('eventid')->unsigned();
            $table->foreign('eventid')
            ->references('eventid')->on('events')
            ->onDelete('cascade');
            $table->integer('commentid')->unsigned();
            $table->foreign('commentid')
            ->references('commentid')->on('comments')
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
        //
    }
}
