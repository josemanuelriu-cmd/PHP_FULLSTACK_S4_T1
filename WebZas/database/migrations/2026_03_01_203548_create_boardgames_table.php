<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('boardgames', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name')->unique();
            $table->string('slug')->unique();//para mejorar la forma de la url, en vez de usar el id, se usa el slug
            $table->integer('min_players');
            $table->integer('max_players');
            $table->integer('min_age');
            $table->integer('duration');            
            $table->longText('description')->nullable();
            //$table->enum('owner_type', ['Zas', 'User']);
            $table->foreignId('owner_user_id')->nullable()->constrained('users')->nullOnDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boardgames');
    }
};
