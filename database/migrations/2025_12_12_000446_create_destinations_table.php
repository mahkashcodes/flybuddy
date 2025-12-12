<?php
// database/migrations/xxxx_create_destinations_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   public function up()
{
    Schema::create('destinations', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description')->nullable();
        $table->string('country');
        $table->string('continent')->nullable();
        $table->string('best_time_to_visit')->nullable();
        $table->integer('starting_price');
        $table->boolean('is_featured')->default(false);
        $table->boolean('is_active')->default(true);
        $table->string('featured_image')->nullable();
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('destinations');
    }
};