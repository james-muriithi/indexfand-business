<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductTagsTable extends Migration
{
    public function up()
    {
        Schema::table('product_tags', function (Blueprint $table) {
            $table->integer('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_2723396')->references('user_id')->on('users');
        });
    }
}
