<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceSchedulesTable extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_schedules', function (Blueprint $table) {
            $table->id('id_schedule');
            $table->unsignedBigInteger('id_vehicle');
            $table->date('maintenance_date');
            $table->string('maintenance_type');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_vehicle')->references('id_vehicle')->on('vehicles');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_schedules');
    }
}

