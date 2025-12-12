// create_carts_table.php
public function up()
{
    Schema::create('carts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        $table->string('session_id')->nullable();
        $table->decimal('total_amount', 10, 2)->default(0);
        $table->timestamps();
    });
}