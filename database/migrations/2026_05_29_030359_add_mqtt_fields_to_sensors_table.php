<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sensors', function (Blueprint $table) {
            $table->string('type')->nullable()->after('data');
            $table->string('topic')->nullable()->after('type');
            $table->decimal('last_value', 10, 2)->nullable()->after('topic');
            $table->timestamp('last_updated')->nullable()->after('last_value');
        });
    }

    public function down(): void
    {
        Schema::table('sensors', function (Blueprint $table) {
            $table->dropColumn(['type', 'topic', 'last_value', 'last_updated']);
        });
    }
};