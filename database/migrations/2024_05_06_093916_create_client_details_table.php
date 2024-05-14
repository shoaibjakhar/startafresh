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
        Schema::create('client_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('surname');
            $table->date('dob');
            $table->string('mobile');
            $table->string('ni_number')->nullable();
            $table->mediumText('answers_to_securiety_questions')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('sort_code_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_details');
    }
};
