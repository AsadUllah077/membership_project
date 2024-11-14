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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->string('ifmp_id');
            $table->string('name');
            $table->string('cnic');
            $table->foreignId('company_id')->references('id')->on('companies');
            $table->string('email')->unique();
            $table->string('mobile');
            $table->string('phone');
            $table->date('m_date');
            $table->string('sba');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
