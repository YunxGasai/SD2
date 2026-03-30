<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users_conferences', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('users_conferences', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'conference_id']);
        });

        Schema::table('users_conferences', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->string('registrant_name')->nullable();
            $table->string('registrant_email')->nullable();
        });

        Schema::table('users_conferences', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users_conferences', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('users_conferences', function (Blueprint $table) {
            $table->dropColumn(['registrant_name', 'registrant_email']);
        });

        Schema::table('users_conferences', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });

        Schema::table('users_conferences', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unique(['user_id', 'conference_id']);
        });
    }
};
