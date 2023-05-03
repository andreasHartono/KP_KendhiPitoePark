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
            $table->text('keterangan');//->nullable();
            $table->enum('status_order', ['Done','Success','Processing','Pending','Canceled']);
            $table->timestamp("created_at")->useCurrent();
            $table->timestamp("updated_at")->nullable()->useCurrentOnUpdate();
            $table->unsignedBigInteger('meja_id');
            $table->double('total_price' , 8, 2);
            $table->bigInteger('cafes_id')->nullable();
            $table->string('jumlah', 5)->nullable();
            $table->string('no_order', 5);
            $table->string('name', 45)->nullable();
            $table->string('jenis_pembayaran', 45);
            $table->string('kode_verifikasi', 255)->nullable();
            $table->string('no_wa', 45)->nullable();
            $table->foreign('meja_id')->references('id')->on('mejas'); 
            
            $table->unsignedBigInteger('account_id');                       
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
