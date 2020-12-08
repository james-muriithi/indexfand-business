<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_2723395')->references('user_id')->on('users');
            $table->unsignedBigInteger('shop_id')->nullable();
            $table->foreign('shop_id', 'shop_fk_2748346')->references('id')->on('shops');
        });
    }
}
