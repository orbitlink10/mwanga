<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('options')) {
            Schema::create('options', function (Blueprint $table) {
                $table->id();
                $table->string('option_key')->nullable()->index();
                $table->longText('option_value')->nullable();
                $table->string('site_name')->nullable();
                $table->integer('site_type')->default(0);
                $table->string('site_email_address')->nullable();
                $table->string('footer_address')->nullable();
                $table->string('site_phone_number')->nullable();
                $table->string('logo')->nullable();
                $table->string('currency_sign')->nullable();
                $table->string('about_title')->nullable();
                $table->text('about_info')->nullable();
                $table->string('profile_name')->nullable();
                $table->string('designation')->nullable();
                $table->string('paypal_client_id', 1000)->nullable();
                $table->string('main_site')->nullable();
                $table->string('post_interval')->nullable();
                $table->string('config_priceperslide')->nullable();
                $table->string('config_coupon')->default('YES');
                $table->string('config_upsells')->default('YES');
                $table->string('afrs_username')->nullable();
                $table->string('afrs_from')->nullable();
                $table->string('afrs_apikey', 1000)->nullable();
                $table->string('sms_count')->default('0');
                $table->string('saseni_savings')->default('0');
                $table->string('sms_balance')->default('0');
            });
        }

        foreach ($this->defaultOptions() as $key => $value) {
            if (! DB::table('options')->where('option_key', $key)->exists()) {
                DB::table('options')->insert([
                    'option_key' => $key,
                    'option_value' => $value,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Keep site settings intact on rollback. This migration may run on a
        // database where the options table already existed outside migrations.
    }

    /**
     * Default options required before the admin settings page is configured.
     *
     * @return array<string, string>
     */
    private function defaultOptions(): array
    {
        return [
            'theme' => 'starlite',
            'site_name' => 'Starlite Internet Kenya',
            'hero_header_title' => 'Starlite Internet Kenya',
            'hero_header_description' => 'Order genuine Starlink kits with professional installation across Kenya.',
            'homepage_description' => '<p>Order genuine Starlink kits with professional installation, delivery, and support across Kenya.</p>',
            'products_section_title' => 'Starlink Kits & Accessories',
            'why_choose_title' => 'Why Choose Starlite Internet Kenya?',
            'why_choose_description' => 'Reliable supply, fast delivery, and professional setup support across Kenya.',
            'about' => '<p>Starlite Internet Kenya supplies Starlink kits and professional installation support across Kenya.</p>',
            'faq' => '<p>Contact our team for current Starlink kit pricing, installation timelines, and support options.</p>',
            'terms' => '<p>Terms and conditions for Starlite Internet Kenya services.</p>',
            'services_page_title' => 'Our Services',
            'services_page_meta' => 'Professional Starlink kit supply, installation, and connectivity support across Kenya.',
            'contact_email' => '',
            'email_address' => '',
            'contact_phone' => '',
            'whatsapp_phone' => '',
            'address' => 'Kenya',
            'facebook' => '',
            'twitter' => '',
            'twiter' => '',
            'instagram' => '',
            'linkedin' => '',
            'youtube' => '',
            'tiktok' => '',
            'logo' => '/assets/images/logo.webp',
            'favicon' => '/assets/images/favicons/favicon-32x32.png',
            'hero_image' => '/assets/images/starlink_1.webp',
            'currency_symbol' => 'KSh',
            'currency_sign' => 'KSh',
            'chat' => '',
            'map' => '',
        ];
    }
};
