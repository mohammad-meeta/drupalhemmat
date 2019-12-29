<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_file', function (Blueprint $table) {
            $table->unsignedBigInteger('file_id');
            $table->foreign('file_id')
                ->references('id')
                ->on('files');

            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id')
                ->references('id')
                ->on('articles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_file');
    }
}
