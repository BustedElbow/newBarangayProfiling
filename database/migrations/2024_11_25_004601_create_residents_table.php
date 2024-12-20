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
        Schema::create('residents', function (Blueprint $table) {
            $table->id('resident_id');
            $table->unsignedBigInteger('identification_number');
            $table->string('image')->nullable();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('sex');
            $table->date('birthdate');
            $table->integer('age');
            $table->string('civil_status');
            $table->string('occupation');
            $table->string('employer');
            $table->string('educational_attainment');
            $table->string('contact_number');
            $table->string('address');
            $table->unsignedBigInteger('purok_id')->nullable();
            $table->string('nationality');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
