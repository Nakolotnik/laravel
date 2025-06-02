<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetricsReportsTable extends Migration
{
    public function up(): void
    {
        Schema::create('metrics_reports', function (Blueprint $table) {
            $table->id('id_report');
            $table->date('report_date');
            $table->float('total_volume_ton_km');
            $table->decimal('total_cost', 18, 2);
            $table->decimal('avg_cost_per_ton_km', 18, 4);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metrics_reports');
    }
}
