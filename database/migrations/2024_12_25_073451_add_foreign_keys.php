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

        Schema::table('resident_logs', function(Blueprint $table) {
            $table->foreign('resident_id')->references('resident_id')->on('residents');
            $table->foreign('official_id')->references('official_id')->on('officials');
        });

        // Schema::table('households', function(Blueprint $table) {
        //     $table->foreign('household_head')->references('resident_id')->on('residents');
        // });

        Schema::table('household_members', function(Blueprint $table) {
            $table->foreign('household_id')->references('household_id')->on('households');
            $table->foreign('resident_id')->references('resident_id')->on('residents');
        });

        Schema::table('brgy_clearances', function(Blueprint $table) {
            $table->foreign('resident_id')->references('resident_id')->on('residents');
            $table->foreign('processed_by')->references('official_id')->on('officials');
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
