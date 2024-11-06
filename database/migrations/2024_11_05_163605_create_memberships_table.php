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
            $table->foreignId('certificate_id')->references('id')->on('certificates');
            $table->string('status');
            $table->integer('dues');
            $table->integer('balance');
            $table->date('m_date');
            $table->date('valid_till');
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
