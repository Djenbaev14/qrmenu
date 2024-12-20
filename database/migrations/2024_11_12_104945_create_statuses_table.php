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
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('statuses')->insert([
            'name'=>'new'
        ]);
        DB::table('statuses')->insert([
            'name'=>'in-process'
        ]);
        DB::table('statuses')->insert([
            'name'=>'expired'
        ]);
        DB::table('statuses')->insert([
            'name'=>'ready'
        ]);
        DB::table('statuses')->insert([
            'name'=>'ready'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
