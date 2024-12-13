<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'api/register', 'api/login'
    ];

    protected function tokensMatch($request)
    {
        $token = $request->input('_token') ?: $request->header('X-CSRF-TOKEN');
        $isValid = hash_equals($request->session()->token(), $token);

        if (!$isValid) {
            \Log::error('CSRF Token Mismatch', [
                'session_token' => $request->session()->token(),
                'request_token' => $token,
            ]);
        }

        return $isValid;
    }
}
