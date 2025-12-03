<?php

use Illuminate\Support\Facades\Request;

if (!function_exists('setActiveMenu')) {
    function setActiveMenu($patterns, $class = 'active')
    {
        foreach ((array) $patterns as $pattern) {
            if (Request::is($pattern) || Request::routeIs($pattern)) {
                return $class;
            }
        }
        return '';
    }
}
