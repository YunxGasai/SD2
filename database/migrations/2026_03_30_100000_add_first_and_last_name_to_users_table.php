<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->default('');
            $table->string('last_name')->default('');
        });

        $users = DB::table('users')->select('id', 'name')->get();
        foreach ($users as $user) {
            $parts = preg_split('/\s+/', trim((string) $user->name), 2);
            DB::table('users')->where('id', $user->id)->update([
                'first_name' => $parts[0] !== '' ? $parts[0] : 'User',
                'last_name' => $parts[1] ?? '-',
            ]);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->default('');
        });

        $users = DB::table('users')->select('id', 'first_name', 'last_name')->get();
        foreach ($users as $user) {
            DB::table('users')->where('id', $user->id)->update([
                'name' => trim($user->first_name.' '.$user->last_name),
            ]);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name']);
        });
    }
};
