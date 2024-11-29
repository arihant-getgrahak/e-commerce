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
        Schema::drop('session_orders');
        Schema::drop('session_carts');
        Schema::drop('guest_orders');
        Schema::drop('guest_addresses');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guest_orders', function (Blueprint $table) {
            //
        });
    }
};
