<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpgrademembershipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upgrademembership', function (Blueprint $table) 
        {
            $table->increments('upgrademembershipid');
            $table->integer('companyid')->unsigned();
            $table->foreign('companyid')
            ->references('companyid')->on('companies')
            ->onDelete('cascade');
            $table->string('upgradeStatus');
            $table->integer('upgradeApproval')->default('0');
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
