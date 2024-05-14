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
        Schema::create('creditor_offices', function (Blueprint $table) {
            $table->id();
            $table->string('office_name');
            $table->string('group_key');
            $table->string('addresses')->nullable();
            $table->string('town_city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('primary_phone');
            $table->string('primary_email');
            $table->string('web')->nullable();
            $table->string('contact_forename');
            $table->string('contact_surname')->nullable();
            $table->string('contact_mobile')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('fair_share')->nullable();
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
        Schema::dropIfExists('creditor_offices');
    }
};
