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
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->string('title');
            $table->longText('message');
            $table->enum('priority', ['low', 'medium', 'high']);
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->string('attachment')->nullable();
            $table->boolean('is_resolved')->default(false);
            $table->softDeletes();
            $table->timestamps();
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
