<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToShopsTable extends Migration
{
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->integer('created_by_id');
            $table->integer('user_id');
            $table->foreign('user_id', 'user_fk_2744403')->references('user_id')->on('users');
            $table->foreign('created_by_id', 'user_fk_2744404')->references('user_id')->on('users');
        });
    }
}
