<?php

if (!function_exists('getActiveRouteClass')) {
    function getActiveRouteClass(string $name, array $parameters = []): string
    {
        return route($name, $parameters) === url()->full() ? 'active' : '';
    }
}

if (!function_exists('toFixed')) {
    function toFixed(int|float $value, int $precision = 2): float
    {
        dd(round($value, $precision));
    }
}
