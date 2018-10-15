<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractorActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractor_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contractor_id');
            $table->string('description');
            $table->boolean('reminder');
            $table->timestamp('remind_on');
            $table->string('action_taken');
            $table->string('customer_remarks');
            $table->string('bde_remarks');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('contractor_id')->references('id')->on('contractors')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contractor_activities');
    }
}
