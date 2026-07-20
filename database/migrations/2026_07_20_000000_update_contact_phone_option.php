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

        DB::table('options')->updateOrInsert(
            ['option_key' => 'whatsapp_phone'],
            ['option_value' => '254714804532']
        );

        DB::table('options')
            ->where(function ($query) {
                $query->where('option_value', 'like', '%+254 729 299 439%')
                    ->orWhere('option_value', 'like', '%254729299439%')
                    ->orWhere('option_value', 'like', '%0701299299%');
            })
            ->update([
                'option_value' => DB::raw(
                    "REPLACE(REPLACE(REPLACE(option_value, '+254 729 299 439', '+254 714804532'), '254729299439', '254714804532'), '0701299299', '+254 714804532')"
                ),
            ]);
    }

    public function down(): void
    {
        // Keep the requested contact number on rollback.
    }
};
