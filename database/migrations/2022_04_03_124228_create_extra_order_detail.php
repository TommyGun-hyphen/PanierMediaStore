<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraOrderDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_order_detail', function (Blueprint $table) {
            $table->foreignId('order_detail_id')->references('id')->on('order_details')->onDelete('cascade');
            $table->foreignId('extra_id')->references('id')->on('extras');
            $table->foreignId('extra_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_order_detail');
    }
}
