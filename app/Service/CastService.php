<?php

namespace App\Services;

class CastService
{
    /** @noinspection MultipleReturnStatementsInspection */
    public static function cast($value, string $type)
    {
        switch ($type) {
            case 'int':
            case 'integer':
                return (int)$value;
            case 'string':
                return (string)$value;
            case 'bool':
            case 'boolean':
                return (bool)$value;
            case 'object':
                return (object)$value;
            case 'array':
                return (array)$value;
            case 'collection':
                return collect((array)$value);
            default:
                return $value;
        }
    }
}
