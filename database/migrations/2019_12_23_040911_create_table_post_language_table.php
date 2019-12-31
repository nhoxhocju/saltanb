<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePostLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_language', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('post_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->string('title')->unique();
            $table->longText('content');
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_language');
    }
}
