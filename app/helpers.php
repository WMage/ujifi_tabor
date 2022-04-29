<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.20.
 * Time: 20:29
 */

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

if (!function_exists("userCan")) {
    /**
     * @param string $jog
     * @param bool $exception
     * @return bool
     * @throws ReflectionException
     * @throws \App\Exceptions\Kiirathato\OlvasasiJogHianyzikException
     * @throws \App\Exceptions\Kiirathato\SzerkesztesiJogHianyzikException
     * @throws \App\Exceptions\Kiirathato\ErvenytelenJogException
     */
    function userCan(string $jog, bool $exception = true): bool
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        return $user->hasPerm($jog, $exception);
    }
}
if (!function_exists("oldV")) {
    function oldV(string $key, $default = "")
    {
        /** @var \Illuminate\Http\Request $request */
        $request = app('request');
        return $request->get($key) ?: $default;
    }
}

if (!function_exists('suspend_sql_full_group_mode')) {
    /**
     * @return void
     */
    function suspend_sql_full_group_mode(): void
    {
        //DB::statement("set session sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
        DB::statement("set session sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");
    }
}

if (!function_exists('taborList')) {
    /**
     * táborok listája, amiknek a regisztrációja nyitva van, illetve bejelentkezett user esetén azon táboroké is, ahova az userhez tartozóan tartozik jelentkezői rekord
     * @return Collection
     * @throws ReflectionException
     */
    function taborList(): Collection
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        return \App\Repositories\TaborRepository::getInstance()->getElerhetoTaborok()->merge(
            $user ? $user->taborok : collect([])
        );
    }
}

if (!function_exists('errorMsg')) {
    function errorMsg(string $msg = "", ?Throwable $e = null): void
    {
        \Session::flash('error', is_null($e) ? $msg : $e->getMessage());
    }
}
