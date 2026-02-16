<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->integer('beds')->nullable()->after('price');
            $table->integer('baths')->nullable()->after('beds');
            $table->decimal('area', 10, 2)->nullable()->after('baths');
            $table->enum('type', ['buy', 'rent'])->default('buy')->after('area');
            $table->enum('availability', ['available', 'sold'])->default('available')->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['beds', 'baths', 'area', 'type', 'availability']);
        });
    }
};
