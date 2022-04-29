<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.21.
 * Time: 21:21
 */

namespace App\Exceptions\Kiirathato;

use Throwable;

class SzerkesztesiJogHianyzikException extends KiirathatoException
{
    protected $user, $permissionName;

    public function __construct(string $permissionName, Throwable $previous = null)
    {
        $this->user = auth()->user();
        $this->permissionName = $permissionName;
        parent::__construct("Nincs jogod szerkeszteni a kért tartalmat", 401, $previous);
    }
}