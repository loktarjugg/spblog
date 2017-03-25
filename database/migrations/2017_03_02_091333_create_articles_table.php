<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->string('cover');
            $table->string('qrcode')->nullable();
            $table->string('original_link')->nullable();
            $table->text('original_body');
            $table->text('body');
            $table->string('description');
            $table->unsignedInteger('vote_count')->default(0);
            $table->unsignedInteger('view_count')->default(0);
            $table->unsignedInteger('last_replies_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('articles');
    }
}
