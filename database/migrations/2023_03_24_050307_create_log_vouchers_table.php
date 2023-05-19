<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_vouchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id'); 
            $table->foreign('account_id')->references('id')->on('users');
            $table->string('kode_voucher',10);
            $table->integer('jumlah');
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
        Schema::dropIfExists('log_vouchers');
    }
}
