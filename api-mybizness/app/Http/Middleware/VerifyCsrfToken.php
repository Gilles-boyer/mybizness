<?php

namespace App\Http\Middleware;
use Closure;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Validator;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/sanctum/csrf-cookie',
        '/app/*',
        '/api/voucher/display/pdf/*'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Illuminate\Session\TokenMismatchException
     */
    public function handle($request, Closure $next)
    {
        // if($this->checkHostExist($request)){
        //     return $this->checkHostExist($request);
        // }

        if (
            $this->isReading($request) ||
            $this->runningUnitTests() ||
            $this->inExceptArray($request) ||
            $this->tokensMatch($request)
        ) {
            return tap($next($request), function ($response) use ($request) {
                if ($this->shouldAddXsrfTokenCookie()) {
                    $this->addCookieToResponse($request, $response);
                }
            });
        }
        throw new TokenMismatchException('CSRF token mismatch.');
    }

    protected function checkHostExist($request)
    {
        $referer = $this->checkDataReferer($request);

        $validator = Validator::make(["referer" => $referer], [
            'referer' => 'required|exists:App\Models\User,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()
            ]);
        }
        return false;
    }

    protected function checkDataReferer($request)
    {
        $header =(array)$request->headers;

        return array_values($header)[0]["referer"][0];
    }

    /**
     * Determine if the HTTP request uses a ‘read’ verb.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function isReading($request)
    {
        return in_array($request->method(), ['HEAD', 'OPTIONS']);
    }
}
