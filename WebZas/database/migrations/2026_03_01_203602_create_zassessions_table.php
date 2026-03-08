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
        Schema::create('zassessions', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name');//nombre del lugar. Can verdaguer, Ate, etc
            $table->string('event_name')->nullable();//nombre del evento. Si es una sesión normal de zas, A rol, LNMLMCDJ, etc
            $table->date('date')->index();
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('max_users');
            $table->string('direction');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zassessions');
    }
};
