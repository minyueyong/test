<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) 
        {
            $table->increments('companyid');
            $table->string('companyName');
            $table->integer('phone');
            $table->string('image');
            $table->string('aboutcompany');
            $table->string('interest');
            $table->string('status');
            $table->date('membershipDate');
            $table->integer('userid')->unsigned();
            $table->foreign('userid')
            ->references('id')->on('users')
            ->onDelete('cascade');
            $table->integer('companyApproval')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
