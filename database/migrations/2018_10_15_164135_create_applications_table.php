<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('application_name');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });

        // Create table for associating applications to packages (Many-to-Many)
        Schema::create('package_applications', function (Blueprint $table) {
            $table->integer('package_id')->unsigned();
            $table->integer('application_id')->unsigned();

            $table->foreign('package_id')->references('id')->on('packages')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('application_id')->references('id')->on('applications')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['package_id', 'application_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_applications');
        Schema::dropIfExists('applications');
    }
}
