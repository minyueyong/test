<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersnpostsncommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usersnpostsncomments', function (Blueprint $table) 
        {
            $table->increments('postcommentfid');
            $table->integer('userid')->unsigned();
            $table->foreign('userid')
            ->references('id')->on('users')
            ->onDelete('cascade');
            $table->integer('postid')->unsigned();
            $table->foreign('postid')
            ->references('postid')->on('posts')
            ->onDelete('cascade');
            $table->integer('postcommentid')->unsigned();
            $table->foreign('postcommentid')
            ->references('postcommentid')->on('postcomments')
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
