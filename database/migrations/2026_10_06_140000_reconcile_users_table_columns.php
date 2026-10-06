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
            if (! Schema::hasColumn('users', 'first_name')) {
                $table->string('first_name')->nullable();
            }

            if (! Schema::hasColumn('users', 'last_name')) {
                $table->string('last_name')->nullable();
            }

            if (! Schema::hasColumn('users', 'deleted_at')) {
                $table->softDeletes();
            }

            if (! Schema::hasColumn('users', 'active')) {
                $table->boolean('active')->default(true);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Keep reconciled columns to avoid dropping existing user data.
    }
};
