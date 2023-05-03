<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCafesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cafes', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string('image');
            $table->string('price');
            $table->string('description');
            $table->string("status")->default("available");
            $table->bigInteger('account_id')->unsigned();
           
            $table->unsignedBigInteger('category_id');        
           
            $table->softDeletes();
            $table->timestamp("created_at")->useCurrent();
            $table->timestamp("updated_at")->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cafes');
    }
}
