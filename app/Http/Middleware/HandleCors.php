<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\HandleCors as Middleware;

class HandleCors extends Middleware
{
    protected $paths = [
        'api/*',
    ];

    protected $allowed_methods = [
        '*',
    ];

    protected $allowed_origins = [
        '*',
    ];

    protected $allowed_origins_patterns = [
        //
    ];

    protected $allowed_headers = [
        '*',
    ];

    protected $exposed_headers = [
        //
    ];

    protected $max_age = 0;

    protected $supports_credentials = false;
}
