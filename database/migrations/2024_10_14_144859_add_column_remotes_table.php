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
        //
        Schema::table('remotes', function (Blueprint $table) {
            //
            $table->string('qrcode_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('remotes', function (Blueprint $table) {
            //
            $table->dropColumn(['qrcode_image']);
        });
    }
};
