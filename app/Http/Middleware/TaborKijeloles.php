<?php

namespace App\Http\Middleware;


use App\Repositories\TaborRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaborKijeloles
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws \ReflectionException
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && empty(TaborRepository::getInstance()->getKijeloltTaborId()) && ($request->route()->getName()!=='admin.index')) {
            return redirect(route('admin.index'));
        }

        return $next($request);
    }
}
