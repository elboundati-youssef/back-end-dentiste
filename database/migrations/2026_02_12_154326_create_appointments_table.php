<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->date('preferred_date'); // Date souhaitée
            $table->string('service'); // Type de soin
            $table->text('message')->nullable(); // Message optionnel
            $table->boolean('terms_accepted')->default(false);
            
            // Statut pour la gestion Admin (En attente, Confirmé, Terminé)
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};