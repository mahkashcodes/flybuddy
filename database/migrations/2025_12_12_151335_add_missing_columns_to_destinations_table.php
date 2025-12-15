<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            // Add is_active if missing
            if (!Schema::hasColumn('destinations', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('is_featured');
            }
            
            // Add featured_image if missing
            if (!Schema::hasColumn('destinations', 'featured_image')) {
                $table->string('featured_image')->nullable()->after('is_active');
            }
        });
    }

    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'featured_image']);
        });
    }
};