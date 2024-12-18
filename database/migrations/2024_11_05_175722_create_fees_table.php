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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->integer('fees_year');
            $table->date('fees_date');
            $table->date('receipt_date');
            $table->integer('amount');
            $table->string('status')->default('unpaid');
            $table->string('fees');
            $table->foreignId('member_id')->references('id')->on('memberships');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
