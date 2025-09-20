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
        Schema::table('permissions', function (Blueprint $table) {
            $table->string('module')->nullable()->after('id');
            $table->string('slug')->nullable()->after('name');

            // Drop old unique index by its real name
            $table->dropUnique('permissions_name_guard_name_unique');

            // Add new combined unique index
            $table->unique(['module', 'slug', 'guard_name'], 'permissions_module_slug_guard_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            // Drop new unique
            $table->dropUnique('permissions_module_slug_guard_unique');

            // Re-add old unique
            $table->unique(['name', 'guard_name'], 'permissions_name_guard_name_unique');

            // Drop added columns
            $table->dropColumn(['module', 'slug']);
        });
    }
};
