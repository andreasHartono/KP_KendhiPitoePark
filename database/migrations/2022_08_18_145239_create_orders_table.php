<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->text('keterangan');
            $table->enum('status_order', ['Done','Waiting','Canceled']);
            $table->timestamps();
            $table->unsignedBigInteger('meja_id');
            $table->double('total_price' , 8, 2);
            $table->bigInteger('cefes_id');
            $table->string('no_order', 5);
            $table->string('name', 45);
            $table->string('jenis_pembayaran', 45);
            $table->unsignedBigInteger('account_id');
            $table->foreign('meja_id')->references('id')->on('mejas');
            $table->foreign('account_id')->references('id')->on('accounts');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
