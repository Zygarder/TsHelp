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
    Schema::create('tickets', function (Blueprint $table) {
        $table->id();
        $table->string('pc_number'); // e.g., "PC-04"
        $table->string('lab_location'); // e.g., "Lab A"
        $table->string('issue_category'); // Hardware, Software, Network
        $table->text('description'); // User's explanation of the problem
        $table->string('status')->default('open'); // open, in-progress, resolved
        $table->string('urgency')->default('normal'); // low, normal, high
        $table->timestamps(); // Automatically tracks 'created_at' and 'updated_at'
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
