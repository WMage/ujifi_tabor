<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.20.
 * Time: 20:29
 */

use Illuminate\Support\Facades\DB;

if (!function_exists("userCan")) {
    /**
     * @param string $jog
     * @param bool $szerkesztheti (true->igen, false->csak megtekintés)
     * @return bool
     * @throws ReflectionException
     */
    function userCan(string $jog, bool $szerkesztheti = false): bool
    {
        /** @var \App\User $user */
        $user = auth()->user();
        return $user->hasPerm($jog, $szerkesztheti);
    }
}
if (!function_exists("userCanException")) {
    /**
     * @param string $jog
     * @param bool $szerkesztheti (true->igen, false->csak megtekintés)
     * @return bool
     * @throws ReflectionException
     * @throws \App\Exception\PermissionMissingException
     */
    function userCanException(string $jog, bool $szerkesztheti = false): bool
    {
        if (!userCan($jog, $szerkesztheti)) {
            throw new \App\Exception\PermissionMissingException($jog, $szerkesztheti);
        }
        return true;
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