<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryStatusesTable extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_statuses', function (Blueprint $table) {
            $table->id('id_status');
            $table->string('status_name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_statuses');
    }
}
