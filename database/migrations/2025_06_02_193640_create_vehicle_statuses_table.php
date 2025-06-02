<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleStatusesTable extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle_statuses', function (Blueprint $table) {
            $table->id('id_status');
            $table->string('status_name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_statuses');
    }
}

