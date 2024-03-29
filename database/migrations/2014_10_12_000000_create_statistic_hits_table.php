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
        Schema::create('statistic_hits', function (Blueprint $table) {
            $table->id();

            $table->nullableMorphs('statisticable');

            $table->text('ua_header')->nullable(true)->default(null)->comment('User Agent Header');
            $table->text('referrer')->length(1000)->nullable(true)->default(null)->comment('Referrer URL');
            $table->ipAddress('ip')->comment('Client IP address');
            
            $table->bigInteger('date')->comment('Date of hit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistic_hits');
    }
};
