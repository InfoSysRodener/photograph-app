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
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->dateTime('date_add')->nullable();
            $table->dateTime('date_over')->nullable();
            $table->dateTime('date_update')->nullable();
         
            $table->unsignedBigInteger('remote_id');
            $table->foreign('remote_id')->references('id')->on('remotes');
            
            $table->foreignIdFor(App\Models\Venue::class)->constrained('venues');
   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
