<?php
namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;
class CORS {

    public function handle(Request $request, Closure $next) {
        header('Access-Control-Allow-Origin:  *');
        header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, PATCH, DELETE');
        header('Access-Control-Allow-Headers: Accept, Content-Type, X-Auth-Token, Origin, Authorization');
        return $next($request);
    }
}
