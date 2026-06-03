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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('user_id');
            $table->string('status')->default('pending');
            $table->decimal('subtotal')->default(0);
            $table->string('coupon_code')->nullable();
            $table->decimal('coupon_discount')->default(0);
            $table->integer('coins_used')->default(0);
            $table->decimal('coin_discount')->default(0);
            $table->decimal('total');
            $table->string('stripe_checkout_session_id')->nullable();
            $table->string('stripe_payment_intent_id')->nullable();
            $table->datetime('paid_at')->nullable();
            $table->datetime('fulfilled_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
