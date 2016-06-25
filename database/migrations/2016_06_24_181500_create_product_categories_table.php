<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
        Schema::create('product_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
        });

        Schema::create('product_product_category', function (Blueprint $table) {
            $table->integer('product_category_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_categories');
    }
}
