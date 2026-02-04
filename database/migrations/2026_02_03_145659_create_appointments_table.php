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
            $table->string('preferred_date'); 
            $table->string('service');        
            $table->text('message');
            
           
            $table->boolean('terms_accepted')->default(false);
            
         
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};