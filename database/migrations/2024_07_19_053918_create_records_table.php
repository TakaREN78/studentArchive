<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration {
    public function up(): void {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('level');
            $table->string('class');
            $table->string('parentContact');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('records');
    }
};
