<?php

namespace App\Http\Middleware;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Closure;

class Language
{
    public function __construct(Application $app, Request $request) {
        $this->app = $app;
        $this->request = $request;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->app->setLocale(session('my_locale', config('app.locale')));

        return $next($request);
    }
}
