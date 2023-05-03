<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeyConstraintToCafesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafes', function (Blueprint $table) {
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('category_id')->references('id')->on('category_food'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cafes', function (Blueprint $table) {
            //
        });
    }
}
