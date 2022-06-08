<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment_text');
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('post_id');
            $table->timestamps();

            $table->foreign('seller_id')
                ->references('id')->on('sellers')
                ->onDelete('cascade');

            $table->foreign('customer_id')
                ->references('id')->on('customers')
                ->onDelete('cascade');

            $table->foreign('post_id')
                ->references('id')->on('posts')
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
        Schema::dropIfExists('comments');
    }
}
