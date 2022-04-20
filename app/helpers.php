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
     */
    function userCan(string $jog, bool $szerkesztheti): bool
    {
        /** @var \App\User $user */
        $user = auth()->user();
        return $user->hasPerm($jog, $szerkesztheti);
    }
}