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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();

            $table->bigIncrements('id');
            $table->timestamps();

            $table->bigInteger('subject_id')->nullable()->comment('URL Id');
            $table->ipAddress('ip')->comment('Client IP address');
            $table->text('ua_header')->nullable(true)->default(null)->comment('User Agent Header');

            $table->string('city', 100)->nullable(true)->default(null)->comment('Client city');
            $table->string('country', 100)->nullable(true)->default(null)->comment('Client country');
            $table->string('country_alpha2', 2)->nullable(true)->default(null)->comment('Client country alpha 2 code');

            $table->string('client', 100)->nullable(true)->default(null)->comment('Client');
            $table->string('client_type', 100)->nullable(true)->default(null)->comment('Client type');
            $table->string('client_version', 100)->nullable(true)->default(null)->comment('Client version');
            $table->string('client_hash', 128)->comment('Client unique hash code');

            $table->string('browser_lang', 5)->nullable(true)->default(null)->comment('Browser language');
            $table->text('referrer')->length(1000)->nullable(true)->default(null)->comment('Referrer URL');
            $table->bigInteger('views')->default(0)->comment('View count');

            $table->boolean('is_bot')->default(false)->comment('Is bot?');
            $table->boolean('is_touchable')->default(false)->comment('Is touchable?');
            $table->boolean('is_mobile')->default(false)->comment('Is mobile?');
            $table->boolean('is_desktop')->default(false)->comment('Is desktop?');
            $table->string('device_type', 100)->nullable(true)->default(null)->comment('Client device type');
            $table->string('device_brand', 100)->nullable(true)->default(null)->comment('Client device brand');
            $table->string('device_model', 100)->nullable(true)->default(null)->comment('Client device model');
            $table->string('os_name', 100)->nullable(true)->default(null)->comment('Operating system name');
            $table->string('os_version', 100)->nullable(true)->default(null)->comment('Operating system version');
            $table->string('platform', 100)->nullable(true)->default(null)->comment('CPU platform');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
