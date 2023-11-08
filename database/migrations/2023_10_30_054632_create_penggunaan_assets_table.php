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
        Schema::create('penggunaan_assets', function (Blueprint $table) {
                $table->id();
                $table->string('transaction_id', 30);
                $table->string('asset_id', 30);
                $table->integer('quantity');
                $table->date('date_from');
                $table->date('date_to');
                $table->integer('duration');
                $table->string('description', 100);
                $table->string('user');
                $table->date('return_date');
                $table->string('return_check', 30);
                $table->string('status', 20);
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaan_assets');
    }
};
