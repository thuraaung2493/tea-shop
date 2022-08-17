<?php

if (!function_exists('getActiveRouteClass')) {
    function getActiveRouteClass(string $name, array $parameters = []): string
    {
        return route($name, $parameters) === url()->full() ? 'active' : '';
    }
}

if (!function_exists('imageNameFromUrl')) {
    function toFixed(string $imageUrl): string
    {
        $paths = explode('/', $imageUrl);

        return $paths[sizeof($paths)];
    }
}

if (!function_exists('getActiveRouteClass')) {
    function getActiveRouteClass(string $name, array $parameters = []): string
    {
        return route($name, $parameters) === url()->full() ? 'active' : '';
    }
}
