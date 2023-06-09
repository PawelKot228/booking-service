<?php

use App\Enums\Currency;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_category_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price');
            $table->unsignedInteger('duration')->default(30);
            $table->string('currency', 32)->default(Currency::EURO->value);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropConstrainedForeignId('company_category_id');
        });

        Schema::dropIfExists('services');
    }
};
