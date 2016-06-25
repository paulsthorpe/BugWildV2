<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('post_categories', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title');
          $table->timestamps();
      });

      Schema::create('post_post_category', function (Blueprint $table) {
          $table->integer('post_category_id')->unsigned()->index();
          $table->integer('post_id')->unsigned()->index();
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
        Schema::drop('post_categories');
    }
}
