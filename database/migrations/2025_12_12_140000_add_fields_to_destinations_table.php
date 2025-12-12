<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('destinations')) {
            // If the destinations table doesn't exist, create it with the required columns
            Schema::create('destinations', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255);
                $table->text('description')->nullable();
                $table->string('country', 100)->nullable();
                $table->string('continent', 50)->nullable();
                $table->string('best_time_to_visit')->nullable();
                $table->decimal('starting_price', 10, 2)->default(0);
                $table->string('featured_image')->nullable();
                $table->timestamps();
            });

            return;
        }

        // Table exists — only add missing columns
        Schema::table('destinations', function (Blueprint $table) {
            if (! Schema::hasColumn('destinations', 'name')) {
                $table->string('name', 255)->after('id');
            }
            if (! Schema::hasColumn('destinations', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
            if (! Schema::hasColumn('destinations', 'country')) {
                $table->string('country', 100)->nullable()->after('description');
            }
            if (! Schema::hasColumn('destinations', 'continent')) {
                $table->string('continent', 50)->nullable()->after('country');
            }
            if (! Schema::hasColumn('destinations', 'best_time_to_visit')) {
                $table->string('best_time_to_visit')->nullable()->after('continent');
            }
            if (! Schema::hasColumn('destinations', 'starting_price')) {
                $table->decimal('starting_price', 10, 2)->default(0)->after('best_time_to_visit');
            }
            if (! Schema::hasColumn('destinations', 'featured_image')) {
                $table->string('featured_image')->nullable()->after('starting_price');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('destinations')) {
            return;
        }

        Schema::table('destinations', function (Blueprint $table) {
            $cols = [
                'name',
                'description',
                'country',
                'continent',
                'best_time_to_visit',
                'starting_price',
                'featured_image',
            ];

            foreach ($cols as $col) {
                if (Schema::hasColumn('destinations', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};