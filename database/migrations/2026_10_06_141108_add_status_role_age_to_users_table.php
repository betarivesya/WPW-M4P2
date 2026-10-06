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
            if (! Schema::hasColumn('users', 'status')) {
                $table->string('status')->default('active');
            }

            if (! Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('member');
            }

            if (! Schema::hasColumn('users', 'age')) {
                $table->unsignedInteger('age')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Preserve user data in case these columns already existed before migration.
    }
};
