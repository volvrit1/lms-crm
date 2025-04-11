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
        Schema::create('primaryplans', function (Blueprint $table) {
            $table->id();
            $table->string('company_id')->nullable();
            $table->string('type')->nullable();
            $table->string('totalamount')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('quantity')->nullable();
            $table->string('coupen')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('primaryplans');

    }
};
