<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractors', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
        });

        // Create table for associating contractors to packages (Many-to-Many)
        Schema::create('package_contractors', function (Blueprint $table) {
            $table->integer('package_id')->unsigned();
            $table->integer('contractor_id')->unsigned();

            $table->foreign('package_id')->references('id')->on('packages')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('contractor_id')->references('id')->on('contractors')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['package_id', 'contractor_id']);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_contractors');
        Schema::dropIfExists('contractors');
    }
}
