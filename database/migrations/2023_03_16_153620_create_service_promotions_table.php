<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('service_promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->foreignId('company_promotion_id')->constrained()->cascadeOnDelete();
            $table->decimal('price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('service_promotions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('service_id');
            $table->dropConstrainedForeignId('company_promotion_id');
        });

        Schema::dropIfExists('service_promotions');
    }
};
