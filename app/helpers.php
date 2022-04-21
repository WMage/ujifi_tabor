<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.20.
 * Time: 20:29
 */
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
        if(!userCan($jog, $szerkesztheti)){
            throw new \App\Exception\PermissionMissingException($jog, $szerkesztheti);
        }
        return true;
    }
}