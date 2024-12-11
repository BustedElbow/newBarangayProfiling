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
        Schema::create('brgy_clearances', function (Blueprint $table) {
            $table->id('clearance_id');
            $table->unsignedBigInteger('resident_id'); //FK resident
            $table->dateTime('request_date');
            $table->string('purpose');
            $table->string('status');
            $table->unsignedBigInteger('processed_by')->nullable(); //FK official
            $table->dateTime('processed_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clearances');
    }
};
