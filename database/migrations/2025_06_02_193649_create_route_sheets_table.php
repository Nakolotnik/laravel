<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteSheetsTable extends Migration
{
    public function up(): void
    {
        Schema::create('route_sheets', function (Blueprint $table) {
            $table->id('id_route_sheet');
            $table->unsignedBigInteger('id_vehicle');
            $table->date('assignment_date');
            $table->string('departure_point');
            $table->string('destination_point');
            $table->float('distance_km');
            $table->time('estimated_time');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_vehicle')->references('id_vehicle')->on('vehicles');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('route_sheets');
    }
}
