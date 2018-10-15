<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });

        // Create table for associating contractors to packages (Many-to-Many)
        Schema::create('tools_categories_applications', function (Blueprint $table) {
            $table->integer('application_id')->unsigned();
            $table->integer('tools_category_id')->unsigned();

            $table->foreign('tools_category_id')->references('id')->on('tools_categories')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('application_id')->references('id')->on('applications')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['tools_category_id', 'application_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tools_categories_applications');
        Schema::dropIfExists('tools_categories');
    }
}
