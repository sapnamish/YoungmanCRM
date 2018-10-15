<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('description');
            $table->decimal('esimate_value', 12,2);
            $table->decimal('rental_value', 12,2);
            $table->boolean('bundle');
            $table->decimal('meters', 12,2)->nullable();
            $table->string('hsn');
            $table->string('material')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Create table for associating contractors to packages (Many-to-Many)
        Schema::create('tool_category_items', function (Blueprint $table) {
            $table->integer('tools_category_id')->unsigned();
            $table->integer('item_id')->unsigned();

            $table->foreign('tools_category_id')->references('id')->on('tools_categories')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['tools_category_id', 'item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tool_category_items');
        Schema::dropIfExists('items');
    }
}
