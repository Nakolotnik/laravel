<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id_order');
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_employee');
            $table->unsignedBigInteger('id_cargo');
            $table->unsignedBigInteger('id_delivery_status');
            $table->unsignedBigInteger('id_contract');
            $table->unsignedBigInteger('id_route_sheet');
            $table->unsignedBigInteger('id_payment');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_client')->references('id_client')->on('clients');
            $table->foreign('id_employee')->references('id_employee')->on('employees');
            $table->foreign('id_cargo')->references('id_cargo')->on('cargos');
            $table->foreign('id_delivery_status')->references('id_status')->on('delivery_statuses');
            $table->foreign('id_contract')->references('id_contract')->on('contracts');
            $table->foreign('id_route_sheet')->references('id_route_sheet')->on('route_sheets');
            $table->foreign('id_payment')->references('id_payment')->on('payments');
            $table->timestamp('creation_date');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
