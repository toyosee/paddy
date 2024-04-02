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
        Schema::table('rides', function (Blueprint $table) {
            //
            $table->string('ride_type')->nullable();
            $table->string('ride_name')->nullable();
            $table->text('details')->nullable();
            $table->integer('capacity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rides', function (Blueprint $table) {
            //
            $table->dropColumn('ride_type');
            $table->dropColumn('ride_name');
            $table->dropColumn('details');
            $table->dropColumn('capacity');
        });
    }
};
