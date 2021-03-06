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
            $table->id();
            $table->string('title', 50)->comment('文章標題');
            $table->text('content')->comment('文章內容');
            $table->integer('catagory_id')->unsigned()->default(1)->comment('分類id');
            $table->string('status', 10)->default('draft')->comment('文章狀態，草稿與正式發布');
            $table->bigInteger('user_id')->unsigned()->comment('使用者id');
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
        Schema::dropIfExists('posts');
    }
}
