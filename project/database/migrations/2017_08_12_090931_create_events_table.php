<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) 
        {
            $table->increments('eventid');
            $table->string('eventName');
            $table->date('eventDate');
            $table->string('eventVenue');
            $table->string('eventImage');
            $table->string('eventFees');
            $table->string('eventDescription');
            $table->integer('companyid')->unsigned();
            $table->foreign('companyid')
            ->references('companyid')->on('companies')
            ->onDelete('cascade');
            $table->integer('eventApproval')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
