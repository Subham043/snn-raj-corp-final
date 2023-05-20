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
        Schema::create('referal_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('member_name', 500);
            $table->string('member_email', 500);
            $table->string('member_phone', 500)->nullable();
            $table->string('member_unit', 500)->nullable();
            $table->foreignId('member_project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->string('referal_name', 500);
            $table->string('referal_email', 500);
            $table->string('referal_phone', 500)->nullable();
            $table->string('referal_relation', 500)->nullable();
            $table->foreignId('referal_project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->timestamps();
            $table->index(['id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referal_enquiries');
    }
};
