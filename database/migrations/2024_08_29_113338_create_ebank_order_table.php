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
        Schema::create('ebank_order', function (Blueprint $table) {
            $table->id();
            
            $table->integer('bank_id');
            $table->integer('user_id');
            $table->foreign('bank_id')->references('id')->on('ebanks')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->integer('count');
            $table->string('price');
            $table->string('mobile_no');
            $table->string('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ebank_order');
    }
};
