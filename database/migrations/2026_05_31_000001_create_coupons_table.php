<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('code')->unique();
            $table->decimal('discount_percent');
            $table->boolean('active')->default(true);
            $table->datetime('starts_at')->nullable();
            $table->datetime('expires_at')->nullable();
            $table->integer('max_uses')->nullable();
            $table->integer('times_used')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
