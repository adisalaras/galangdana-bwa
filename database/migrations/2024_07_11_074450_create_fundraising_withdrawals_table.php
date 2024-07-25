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
        Schema::create('fundraising_withdrawals', function (Blueprint $table) {
            $table->id();
            $table->string('proof');
            $table->string('bank_name');
            $table->string('bank_account_name');
            $table->string('bank_account_number');
            $table->integer('amount_requested');
            $table->integer('amount_received');
            $table->boolean('has_received');
            $table->boolean('has_set');
            $table->foreignId('fundraising_id')->constrained()->onDelete('cascade');
            $table->foreignId('fundraiser_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fundraising_withdrawals');
    }
};
