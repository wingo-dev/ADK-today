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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            // start
            $table->foreignId('vendor_id')->constrained('users')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->longText('long_description')->nullable();
            $table->longText('short_description')->nullable();

            $table->string('thumbnail')->nullable();
            $table->string('image')->nullable();

            $table->date('start_date')->nullable();
            $table->time('start_time')->nullable();
            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable();

            $table->string('address')->nullable();
            $table->string('coordinates')->nullable();
            $table->string('event_url')->nullable();

            $table->foreignId('county_id')->constrained('counties')->cascadeOnDelete();
            $table->foreignId('town_id')->constrained('towns')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();

            $table->boolean('is_free')->default(0);
            $table->double('cost')->nullable();

            // end
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
