<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.21.
 * Time: 21:21
 */

namespace App\Exception;

use Throwable;

class PermissionMissingException extends \Exception
{
    protected $user, $permissionName, $edit;

    public function __construct(string $permissionName, bool $edit, Throwable $previous = null)
    {
        $this->user = auth()->user();
        $this->permissionName = $permissionName;
        $this->edit = $edit;
        parent::__construct("", 401, $previous);
    }
}