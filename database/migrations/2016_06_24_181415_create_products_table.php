<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title');
          $table->string('slug');
          $table->integer('price');
          $table->string('image1');
          $table->string('image2');
          $table->string('image3');
          $table->text('description');
          $table->timestamps();
        });

        Schema::create('product_product_size', function (Blueprint $table) {
            $table->integer('product_size_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::create('product_product_color', function (Blueprint $table) {
            $table->integer('product_color_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::create('featured_product_product', function (Blueprint $table) {
            $table->integer('featured_product_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::create('on_sale_product', function (Blueprint $table) {
            $table->integer('on_sale_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
