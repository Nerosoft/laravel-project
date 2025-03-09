<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class IsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    function getUrl($state){
        if($state === 'admin')
            return '/admin/login';
        else if($state === 'patent')
            return '/login';
        else 
            return '/doctor/login';
    }
    public function handle(Request $request, Closure $next, $state): Response
    {  
        if($request->session()->exists('userId') && $state === 'admin' ||
          $request->session()->exists('patentId') && $state === 'patent' ||
          $request->session()->exists('doctorId') && $state === 'doctor')
            return $next($request);
        else
            return redirect($this->getUrl($state));  
    }
}
