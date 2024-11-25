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
        Schema::table('carts', function (Blueprint $table) {
            $table->string('name')->default('');
        });
        Schema::table('session_carts', function (Blueprint $table) {
            $table->string('name')->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('name');
        });
        Schema::table('session_carts', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
};
