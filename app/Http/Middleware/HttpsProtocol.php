<?php

namespace App\Http\Middleware;

use App\Http\Controllers\CommonFunctionTrait;
use Closure;

class HttpsProtocol {
    use CommonFunctionTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if($request->get('token')){
            $token = $request->get('token');
         //   $this->decodeKey($token);
  
            try{    
                if(!$this->decodeKey($token)){
                    
                    abort(404);
                }
                
            } catch (\Throwable $e) {
                return redirect()->route('home');
            }

        }
        
        if (env('FORCE_HTTPS') == "On" && !$request->secure()) {
            return redirect()->secure($request->getRequestUri());
        }
        return $next($request);
    }
}
