<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('shop_name');
            $table->string('location');
            $table->string('industry');
            $table->string('description')->nullable();
            $table->string('short_name');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
