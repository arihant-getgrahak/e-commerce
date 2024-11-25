<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('order_products', function ($table) {
            $table->dropColumn('status');
            $table->dropColumn('delivery_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_products', function ($table) {
            $table->string('status');
            $table->datetime('delivery_date');
        });
    }
};
