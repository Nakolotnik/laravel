<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id('id_vehicle');
            $table->string('model');
            $table->string('license_plate');
            $table->float('capacity_kg');
            $table->unsignedBigInteger('id_status');
            $table->string('gps_location')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_status')->references('id_status')->on('vehicle_statuses');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
}
