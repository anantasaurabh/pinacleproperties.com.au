<?php

namespace App\Helpers;

use Illuminate\Support\Facades\View;

class ShortcodeHelper
{
    public static function parse($content)
    {
        if (empty($content)) return $content;

        // 1. Parse ##form::name##
        $content = preg_replace_callback('/##form::([a-zA-Z0-9_-]+)##/', function ($matches) {
            $formName = $matches[1];
            if (View::exists("forms.$formName")) {
                return view("forms.$formName")->render();
            }
            return "<!-- Form $formName not found -->";
        }, $content);

        // 2. Parse ##map::address##
        $content = preg_replace_callback('/##map::([^#]+)##/', function ($matches) {
            $address = urlencode($matches[1]);
            return '<div class="map-wrapper">
                <iframe 
                    src="https://www.google.com/maps/embed/v1/place?key=' . env('GOOGLE_MAPS_API_KEY', '') . '&q=' . $address . '" 
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>';
        }, $content);

        // 3. Fallback for no-key embed if API key is missing
        $content = preg_replace_callback('/##map_embed::([^#]+)##/', function ($matches) {
            $address = urlencode($matches[1]);
            return '<div class="map-wrapper">
                <iframe 
                    src="https://maps.google.com/maps?q=' . $address . '&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>';
        }, $content);

        // 4. Parse [form name="name"]
        $content = preg_replace_callback('/\[form\s+name=["\']([a-zA-Z0-9_-]+)["\']\s*\]/', function ($matches) {
            $formName = $matches[1];
            if (View::exists("forms.$formName")) {
                return view("forms.$formName")->render();
            }
            return "<!-- Form $formName not found -->";
        }, $content);

        return $content;
    }
}
