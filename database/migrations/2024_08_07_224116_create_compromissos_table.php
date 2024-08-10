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
        Schema::create('compromissos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consultor_id');
            $table->date('data');
            $table->time('hora_inicio');
            $table->time('hora_fim');
            $table->time('intervalo');
            $table->timestamps();

            $table->foreign('consultor_id')->references('id')->on('consultores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compromissos');
    }
};
