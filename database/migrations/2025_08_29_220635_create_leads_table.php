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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('mobilephone');
            $table->string('ilu_depcolombia');
            $table->string('ilu_cityofresidencecolombia');
            $table->string('ilu_opportunitytype');
            $table->string('modality');
            $table->string('program');
            $table->string('sede');
            $table->string('tipo_de_documento');
            $table->string('ilu_numerodocumento');
            $table->string('preferred_contact_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
