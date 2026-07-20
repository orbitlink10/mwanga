<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('options')) {
            return;
        }

        DB::table('options')->updateOrInsert(
            ['option_key' => 'contact_phone'],
            ['option_value' => '+254 714804532']
        );
    }

    public function down(): void
    {
        // Keep the requested contact number on rollback.
    }
};
