<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('atributes', function (Blueprint $table) {
            $table->id();
            $table->string('name_uz')->unique();
            $table->string('name_ru')->unique();
            $table->string('name_kr')->unique();
            $table->timestamps();
        });
        
        DB::table('atributes')->insert([
            'name_uz'=>'Material',
            'name_ru'=>'Материал',
            'name_kr'=>'Material',
        ]);
        
        DB::table('atributes')->insert([
            'name_uz'=>"O'lcham",
            'name_ru'=>"Размер",
            'name_kr'=>"O'lshem",
        ]);
        DB::table('atributes')->insert([
            'name_uz'=>"Rang",
            'name_ru'=>"Цвет",
            'name_kr'=>"Ren'",
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atributes');
    }
};
