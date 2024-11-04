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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('name_uz');
            $table->string('name_ru');
            $table->string('name_kr');
            $table->longText('description_uz')->nullable();
            $table->longText('description_ru')->nullable();
            $table->longText('description_kr')->nullable();
            $table->string('price')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('units');
            $table->string('slug')->unique();
            $table->json('photos');
            $table->boolean('is_active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
