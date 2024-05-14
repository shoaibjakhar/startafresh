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
        Schema::create('client_debts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('creditor_office_id');
            $table->string('debt_reference')->nullable();
            $table->integer('balance');
            $table->integer('total_paid');
            $table->integer('current_debt');
            $table->integer('offer');
            $table->enum('acceptance_status', ['Not Accepted', 'Accepted']);
            $table->date('acceptance_date');
            $table->mediumText('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_debts');
    }
};
