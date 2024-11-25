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
        Schema::create('blood_relations', function (Blueprint $table) {
            $table->id('blood_relation_id');
            $table->unsignedBigInteger('related_to_resident_id');
            $table->string('name');
            $table->string('relationship');
            $table->unsignedBigInteger('resident_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_relations');
    }
};
