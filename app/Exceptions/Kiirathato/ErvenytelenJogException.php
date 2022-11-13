<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.21.
 * Time: 21:21
 */

namespace App\Exceptions\Kiirathato;

use Illuminate\Contracts\Auth\Authenticatable;
use Throwable;

class ErvenytelenJogException extends KiirathatoException
{
    protected ?Authenticatable $user;
    protected string $permissionName;

    public function __construct(string $permissionName, Throwable $previous = null)
    {
        $this->user = auth()->user();
        $this->permissionName = $permissionName;
        parent::__construct("A keresett jogosultság formátuma érvénytelen, értesítettük az üzemeltetést a hibáról.", 500, $previous);
    }
}
