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
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('general'); // general:일반, popup:팝업
            $table->string('title');
            $table->longText('content')->nullable();
            $table->boolean('is_active')->default(true); // 노출 여부
            $table->timestamp('start_date')->nullable(); // 팝업 시작일
            $table->timestamp('end_date')->nullable();   // 팝업 종료일
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
