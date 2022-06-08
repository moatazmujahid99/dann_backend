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
            $table->text('description');
            $table->string('post_img')->nullable();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->timestamps();

            $table->foreign('seller_id')
                ->references('id')->on('sellers')
                ->onDelete('cascade');

            $table->foreign('customer_id')
                ->references('id')->on('customers')
                ->onDelete('cascade');
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
