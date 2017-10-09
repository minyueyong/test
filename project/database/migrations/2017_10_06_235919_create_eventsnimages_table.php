<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsnimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventsnimages', function (Blueprint $table) 
        {
            $table->increments('eventnimageid');
            $table->integer('eventid')->unsigned();
            $table->foreign('eventid')
            ->references('eventid')->on('events')
            ->onDelete('cascade');
            $table->integer('imageid')->unsigned();
            $table->foreign('imageid')
            ->references('imageid')->on('images')
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
