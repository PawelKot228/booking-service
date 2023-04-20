<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->text('description');
            $table->string('street_name');
            $table->string('street_number', 64);
            $table->string('apartment_number', 64)->nullable();
            $table->string('zip_code', 64)->nullable();
            $table->string('city');
            $table->text('open_hours')->nullable();
            $table->float('latitude');
            $table->float('longitude');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
        });

        Schema::dropIfExists('companies');
    }
};
