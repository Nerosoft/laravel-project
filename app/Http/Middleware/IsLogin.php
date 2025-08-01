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
    public function handle(Request $request, Closure $next, $state): Response
    {  
        if($request->session()->exists('userId') && $state === 'admin' 

        || $request->session()->exists('userId') && $state === 'test' && $request->route('id') === 'Test' 
        || $request->session()->exists('userId') && $state === 'test' && $request->route('id') === 'Cultures' 
        || $request->session()->exists('userId') && $state === 'test' && $request->route('id') === 'Packages'
        || $request->session()->exists('userId') && $state === 'test' && $request->route('id') === 'Contracts' 
        || $request->session()->exists('userId') && $state === 'test' && $request->route('id') === 'Knows' 
        || $request->session()->exists('userId') && $state === 'test' && $request->route('id') === 'Patent'
        || $request->session()->exists('userId') && $state === 'test' && $request->route('id') === 'Receipt'
        || $request->session()->exists('userId') && $state === 'test' && $request->route('id') === 'Branch'
        
        
        )
            return $next($request);
        else if($request->session()->exists('userId') && $state === 'test')
            return redirect()->route('Home');
        else
            return redirect('/admin/login');  
    }
}
