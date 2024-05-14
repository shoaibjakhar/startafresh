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
        Schema::create('client_incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constained()->onDelete('cascade');
            $table->string('income_type_key');
            $table->integer('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_incomes');
    }
};
