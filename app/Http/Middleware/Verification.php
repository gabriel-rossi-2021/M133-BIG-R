<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Symfony\Component\HttpFoundation\Response;

class Verification extends Middleware
{

    public function handle($request, Closure $next, ...$guards): Response
    {
        // SI PAS CO REDIRECTION SUR LA VUE CONNEXION
        if (!$request->session()->has('user')) {
            return redirect()->route('vue_connexion');
        }

        return parent::handle($request, $next, ...$guards);
    }
}
