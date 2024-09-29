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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')
                ->nullable()->after('name');
            $table->string('last_name')
                ->nullable()->after('first_name');
            $table->string('role')
                ->nullable()->after('last_name');
            $table->string('status')
                ->default(\App\Enum\UserStatus::ACTIVE)->after('role');
            $table->string('user_storage_type')
                ->default(\App\Enum\UserStorageType::MIXPANEL)->after('role');
            $table->dateTime('last_synced_at')
                ->nullable()->after('updated_at');


            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('role');
        });
    }
};
