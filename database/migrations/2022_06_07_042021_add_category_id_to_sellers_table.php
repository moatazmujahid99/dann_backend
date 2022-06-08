<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
                ->references('id')->on('seller_categories')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('sellers', function(Blueprint $table){
            $table->dropForeign(['category_id']);
        });

        Schema::dropIfExists('sellers');
        Schema::enableForeignKeyConstraints();

        // Schema::table('sellers', function (Blueprint $table) {
        //     $table->dropForeign(['category_id']);
        //     $table->dropColumn('category_id');
        // });
    }
}
