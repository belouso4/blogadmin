<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id')->unsigned();
            $table->tinyInteger('category_id')->unsigned();
            $table->string('title',255);
            $table->string('alias',255)->unique();
            $table->text('content')->nullable();
            $table->enum('status',['0','1'])->default(1);
            $table->string('keywords',255)->default(NULL)->nullable();
            $table->string('description',255)->default(NULL)->nullable();
            $table->string('img',255)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
