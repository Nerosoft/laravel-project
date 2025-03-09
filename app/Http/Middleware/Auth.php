<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $state): Response
    {
        if($request->session()->exists('userId') && $state === 'admin')
            return redirect()->route('Home');
        else if($request->session()->exists('patentId') && $state === 'patent')
            return redirect()->route('PatentDashboard');
        else if($request->session()->exists('doctorId') && $state === 'doctor')
            return redirect()->route('DoctorDashboard');
        else
            return $next($request);
    }
}
