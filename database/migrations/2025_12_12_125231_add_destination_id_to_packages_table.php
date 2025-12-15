<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('travel_packages', function (Blueprint $table) {
            // Check if column doesn't exist first
            if (!Schema::hasColumn('travel_packages', 'destination_id')) {
                $table->unsignedBigInteger('destination_id')->nullable()->after('id');
                
                // Add foreign key constraint
                $table->foreign('destination_id')
                      ->references('id')
                      ->on('destinations')
                      ->onDelete('set null');
            }
        });
    }

    public function down()
    {
        Schema::table('travel_packages', function (Blueprint $table) {
            // Drop the foreign key first
            $table->dropForeign(['destination_id']);
            // Then drop the column
            $table->dropColumn('destination_id');
        });
    }
};