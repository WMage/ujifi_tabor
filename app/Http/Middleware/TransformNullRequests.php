<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;

/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.29.
 * Time: 23:01
 */
class TransformNullRequests extends ConvertEmptyStringsToNull
{
    protected function transform($key, $value)
    {
        return is_string($value) && ($value === '' || $value === 'null') ? null : $value;
    }
}