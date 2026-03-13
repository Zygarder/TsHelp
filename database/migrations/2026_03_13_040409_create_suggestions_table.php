<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suggestions', function (Blueprint $table) {
            $table->id();
            $table->text('content'); // The actual suggestion/feedback
            $table->string('submitted_by'); // Name or ID of who submitted it
            $table->boolean('is_read')->default(false); // Admin read status
            $table->timestamps(); // Automatically handles 'submittedAt' (created_at)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suggestions');
    }
};