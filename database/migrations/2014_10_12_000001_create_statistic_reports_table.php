<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statistic_reports', function (Blueprint $table) {
            $table->id();

            $table->nullableMorphs('statisticable');

            $table->dateTime('start_date')->comment('Start date');
            $table->dateTime('end_date')->comment('End date');
            $table->string('type', 100)->comment('Report type');
            $table->string('name', 100)->comment('Report name');
            $table->json('data')->comment('Report data');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistic_reports');
    }
};
