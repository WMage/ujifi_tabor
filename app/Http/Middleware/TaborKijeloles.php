<?php

namespace App\Http\Middleware;

use App\Exceptions\Kiirathato\NincsTaborMeghatarozvaException;
use App\Repositories\TaborRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ReflectionException;

class TaborKijeloles
{
    /**
     * Azon route nevek listája, ahol az ellenőrzést nem kell végrehajtani
     * @var array|string[]
     */
    protected array $kiveve = [
        'admin.index',
        'admin.gitPull',
        'logout',
    ];

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws ReflectionException
     * @throws NincsTaborMeghatarozvaException
     */
    public function handle(Request $request, Closure $next)
    {
        $taborRepo = TaborRepository::getInstance();
        if ($id = (int)$request->get('tabor_id')) {
            $taborRepo->setKijeloltTaborId($id);
        }
        if (
            Auth::check()
            &&
            empty($taborRepo->getKijeloltTaborId())
            &&
            (!in_array($request->route()->getName(), $this->kiveve, true))
        ) {
            if ($request->wantsJson()) {
                throw new NincsTaborMeghatarozvaException();
            }
            return redirect(route('admin.index'));
        }
        return $next($request);
    }
}
