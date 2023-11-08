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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('complaint_id', 30);
            $table->string('complaint_type', 50);
            $table->string('description', 255);
            $table->string('attachement');
            $table->string('status', 20);
            $table->date('followup_date');
            $table->string('followup_note', 255);
            $table->date('execution_date');
            $table->string('execution_note', 255);
            $table->string('execution_attachement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
