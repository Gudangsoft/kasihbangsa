<?php

use Illuminate\Support\Facades\Route;
use App\Models\HomeSetting;

if (!function_exists('homeSettings')) {
    function homeSettings()
    {
        return HomeSetting::getSettings();
    }
}
