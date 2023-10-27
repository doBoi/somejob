<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            // $table->integer('buyer_id')->nullable();
            // $table->integer('freelancer_id')->nullable();
            // $table->integer('service_id')->nullable();

            $table->foreignId('buyer_id')->index('fk_order_buyer_to_users');
            $table->foreignId('freelancer_id')->index('fk_order_freelancer_to_users');
            $table->foreignId('service_id')->index('fk_order_buyer_to_service');

            $table->longtext('file')->nullable();
            $table->longtext('note')->nullable();
            $table->date('expired')->nullable();
            // $table->integer('order_status_id')->nullable();
            $table->foreignId('order_status_id')->index('fk_order_to_order_status');
            $table->softDeletes();
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
        Schema::dropIfExists('order');
    }
}
