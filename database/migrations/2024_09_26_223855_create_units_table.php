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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('units')->insert([
            'name'=>'dona'
        ]);
        
        DB::table('units')->insert([
            'name'=>'metr'
        ]);
        
        DB::table('units')->insert([
            'name'=>'portsiya'
        ]);
        
        DB::table('units')->insert([
            'name'=>'kilogramm'
        ]);
        
        DB::table('units')->insert([
            'name'=>'gramm'
        ]);
        
        DB::table('units')->insert([
            'name'=>'santimetr'
        ]);
        
        DB::table('units')->insert([
            'name'=>'tonna'
        ]);
        
        DB::table('units')->insert([
            'name'=>'kvadrat metr'
        ]);
        
        DB::table('units')->insert([
            'name'=>'kub metr'
        ]);
        
        DB::table('units')->insert([
            'name'=>'litr'
        ]);
        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
