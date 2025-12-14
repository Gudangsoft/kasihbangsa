<?php

// namespace App\Helpers;

use App\Models\CompanyProfile;

function company()
{
    $data = CompanyProfile::latest()->first();

    return $data;
}

if (!function_exists('isDesktop')) {
    function isDesktop()
    {
        return !request()->header('User-Agent') || !preg_match('/(tablet|ipad|iphone|ipod|android|blackberry|iemobile|windows phone)/i', request()->header('User-Agent'));
    }
}
