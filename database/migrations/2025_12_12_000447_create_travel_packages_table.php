<?php
// database/migrations/xxxx_create_travel_packages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('travel_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->integer('duration_days');
            $table->decimal('price', 10, 2);
            $table->json('inclusions')->nullable(); // ["Flight", "Hotel", "Breakfast"]
            $table->json('exclusions')->nullable(); // ["Visa", "Insurance"]
            $table->integer('max_people')->default(10);
            $table->boolean('is_active')->default(true);
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('travel_packages');
    }
};