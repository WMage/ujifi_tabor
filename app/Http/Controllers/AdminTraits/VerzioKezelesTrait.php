<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.05.04.
 * Time: 20:46
 */

namespace App\Http\Controllers\AdminTraits;

trait VerzioKezelesTrait
{
    public function pull(): void
    {
        dd(exec('cd.. && pwd'),exec('cd.. && pwd'));
        dd(exec('cd.. && git reset --hard && git pull'));
    }
}
