<?php
namespace CCTools\Middlewares;

use Closure;
use Illuminate\Http\Request;

class XssMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $input = $request->all();
        array_walk_recursive($input,function(&$input){
            $input = strip_tags($input);
        });
        $request->merge($input);
        return $next($request);
    }
}