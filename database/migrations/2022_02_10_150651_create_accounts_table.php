<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('accounts', function (Blueprint $table) {
        //     $table->softDeletes();
        //     $table->id();
        //     $table->string('username');
        //     $table->string('phone');
        //     $table->string('name');
        //     $table->string('address')->nullable();
        //     $table->string('password');
        //     $table->integer('is_admin')->default(0);

        //     $table->integer('emoney')->default(0);
        //     $table->string("jabatan")->default('pelanggan');
        //     $table->timestamp("created_at")->useCurrent();
        //     $table->timestamp("updated_at")->nullable()->useCurrentOnUpdate();
            
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
