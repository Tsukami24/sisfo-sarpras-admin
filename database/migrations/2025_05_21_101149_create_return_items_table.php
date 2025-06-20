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
        Schema::create('return_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained();
            $table->foreignId('admin_id')->nullable()->constrained();
            $table->foreignId('item_id')->nullable()->constrained('items')->nullOnDelete();
            $table->integer('quantity');
            $table->enum('condition', ['baik', 'rusak', 'hilang'])->default('baik');
            $table->decimal('fine', 10, 2)->default(0);
            $table->datetime('returned_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_items');
    }
};
