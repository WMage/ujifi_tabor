<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.21.
 * Time: 21:21
 */

namespace App\Exceptions;

use Throwable;

class NincsTaborMeghatarozvaException extends \Exception
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct("", 412, $previous);
    }
}