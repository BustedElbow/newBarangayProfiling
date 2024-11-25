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

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('resident_id')->references('resident_id')->on('residents');
        });

        Schema::table('officials', function (Blueprint $table) {
            $table->foreign('resident_id')->references('resident_id')->on('residents');
        });

        Schema::table('blood_relations', function (Blueprint $table) {
            $table->foreign('resident_id')->references('resident_id')->on('residents');
            $table->foreign('related_to_resident_id')->references('resident_id')->on('residents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
