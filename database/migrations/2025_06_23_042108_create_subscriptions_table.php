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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('phone');
            $table->foreignId('plan_id')->constrained('meal_plans')->onDelete('cascade');
            $table->string('meal_types');
            $table->string('delivery_days');
            $table->text('allergies')->nullable();
            $table->enum('status', ['ACTIVE', 'PAUSE', 'CANCEL']);
            $table->date('end_date')->nullable();
            $table->date('pause_period_start')->nullable();
            $table->date('pause_period_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
