<?php

declare(strict_types=1);

if (! function_exists('domain')) {

    function domain(): string
    {
        return parse_url(config('app.domain'), PHP_URL_HOST);
    }
}

if (! function_exists('subdomain')) {
    function subdomain(string $subdomain): string
    {
        return "{$subdomain}.".domain();
    }
}
