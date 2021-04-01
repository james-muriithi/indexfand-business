<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWithdrawsTable extends Migration
{
    public function up()
    {
        Schema::table('business_withdraws', function (Blueprint $table) {
            $table->unsignedInteger('business_id')->after('amount');
            $table->foreign('business_id', 'business_fk_3577073')->references('id')->on('business');
        });
    }
}
