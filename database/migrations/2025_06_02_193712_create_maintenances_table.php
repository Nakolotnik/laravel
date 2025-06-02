<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenancesTable extends Migration
{
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id('id_maintenance');
            $table->unsignedBigInteger('id_vehicle');
            $table->unsignedBigInteger('id_employee');
            $table->date('planned_date');
            $table->date('completion_date')->nullable();
            $table->text('work_description');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_vehicle')->references('id_vehicle')->on('vehicles');
            $table->foreign('id_employee')->references('id_employee')->on('employees');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
}

