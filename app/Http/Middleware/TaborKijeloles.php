<?php

namespace App\Http\Middleware;


use App\Exception\NincsTaborMeghatarozvaException;
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
     * @throws NincsTaborMeghatarozvaException
     */
    public function handle(Request $request, Closure $next)
    {
        $taborRepo = TaborRepository::getInstance();
        if($id = (int)$request->get('tabor_id')) {
            $taborRepo->setKijeloltTaborId($id);
        }
        if (Auth::check() && empty($taborRepo->getKijeloltTaborId()) && ($request->route()->getName()!=='admin.index')) {
            if($request->wantsJson()){
                throw new NincsTaborMeghatarozvaException();
            }
            return redirect(route('admin.index'));
        }
        return $next($request);
    }
}
