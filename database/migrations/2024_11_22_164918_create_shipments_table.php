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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->int('order_id');
            $table->foreignId('channel_order_id')->constrained('orders')->onDelete('cascade');
            $table->int('shipment_id');
            $table->string('courier_name');
            $table->string('status');
            $table->foreignId('pickup_address_id')->constrained('pickup_addresses')->onDelete('cascade');
            $table->decimal('actual_weight', 8, 2);
            $table->decimal('volumetric_weight', 8, 2);
            $table->string('platform');
            $table->float('charges');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
