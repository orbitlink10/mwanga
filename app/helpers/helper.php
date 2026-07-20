<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;

function normalizeFilePath($path){
    return str_replace(['/', "\\"], DIRECTORY_SEPARATOR, $path);
}

function get_uploaded_image($path){
    if(!isset($path)){
        abort(404);
    }

    $path = normalizeFilePath(storage_path('/app/public/' . $path));

    if(!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
}



    function get_option($option_key = '', $default = null){
      $defaults = [
        'theme' => 'starlite',
        'site_name' => 'Starlite Internet Kenya',
        'hero_header_title' => 'Starlite Internet Kenya',
        'hero_header_description' => 'Order genuine Starlink kits with professional installation across Kenya.',
        'homepage_description' => 'Order genuine Starlink kits with professional installation, delivery, and support across Kenya.',
        'products_section_title' => 'Starlink Kits & Accessories',
        'why_choose_title' => 'Why Choose Starlite Internet Kenya?',
        'why_choose_description' => 'Reliable supply, fast delivery, and professional setup support across Kenya.',
        'about' => 'Starlite Internet Kenya supplies Starlink kits and professional installation support across Kenya.',
        'faq' => 'Contact our team for current Starlink kit pricing, installation timelines, and support options.',
        'terms' => 'Terms and conditions for Starlite Internet Kenya services.',
        'services_page_title' => 'Our Services',
        'services_page_meta' => 'Professional Starlink kit supply, installation, and connectivity support across Kenya.',
        'contact_email' => '',
        'email_address' => '',
        'contact_phone' => '+254 714804532',
        'whatsapp_phone' => '254714804532',
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

      $fallback = $default ?? ($defaults[$option_key] ?? $option_key);

      try {
        if (! Schema::hasTable('options')) {
          return $fallback;
        }

        $get = \App\Models\Option::where('option_key', $option_key)->first();
        if($get) {
          return $get->option_value ?? $fallback;
        }
      } catch (\Throwable $exception) {
        return $fallback;
      }

      return $fallback;
    }



function upload_photo($photo){
    $fileNameWithExt = $photo->getClientOriginalName();
    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    $extension = $photo->getClientOriginalExtension();
    $filenameToStore = $fileName . '-' . time() . '.' . $extension;
    $photo->storeAs('uploads/images/', $filenameToStore, 'public');
    $photoPath = 'uploads/images/' . $filenameToStore;
    return $photoPath;
}
