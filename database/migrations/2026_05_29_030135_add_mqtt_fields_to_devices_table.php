<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->string('device_id')->unique()->nullable()->after('meta_data');
            $table->string('topic')->nullable()->after('device_id');
            $table->enum('status', ['online', 'offline'])->default('offline')->after('topic');
            $table->timestamp('last_activity')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropColumn(['device_id', 'topic', 'status', 'last_activity']);
        });
    }
};