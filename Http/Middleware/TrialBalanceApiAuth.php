<?php

namespace Oem\BrpRise\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\Services\AuthenticationService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Closure;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TrialBalanceApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null ...$guards
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $auth = App::make(AuthenticationService::class);
        if (!$auth->authenticate($request->getUser(), $request->getPassword())) {
            // 'Invalid Login Credentials' is consistent with legacy code
            return response('Invalid Login Credentials', 401);
        }

        return $next($request);
    }
}
