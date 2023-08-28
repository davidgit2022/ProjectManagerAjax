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
        Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->decimal('budget', 50, 20)->default(0);
        $table->date('execution_date');
        $table->tinyInteger('is_active')->default(0);

        $table->unsignedBigInteger('city_id');
        $table->foreign('city_id')->references('id')->on('cities');

        $table->unsignedBigInteger('company_id');
        $table->foreign('company_id')->references('id')->on('companies');

        $table->unsignedBigInteger('user_id');
        $table->foreign('user_id')->references('id')->on('users');


        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
