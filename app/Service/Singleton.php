<?php

namespace App\Service;

use ReflectionMethod;

/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2018.08.13.
 * Time: 20:40
 */
class Singleton
{
    protected static $sessionData;
    private static $instances = array();
    protected $className;
    protected $initMethod = "Load";

    protected function __construct()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        self::$sessionData = &$_SESSION;
    }

    /**
     * @param string $name
     * @param array $params
     * @return mixed
     * @throws \ReflectionException
     */
    public static function getInstance($name = '', $params = array())
    {

        if (($callerName = get_called_class()) != get_class()) {
            $params = $name;
            $name = $callerName;
        }
        $class = &self::$instances[$name];
        if (!isset(self::$instances[$name])) {
            if (empty($params)) {
                self::$instances[$name] = new $name();
            } else {
                self::$instances[$name] = new $name(...$params);
            }

            $initMethod = "Load";
            if (self::$instances[$name] instanceof self) {
                $initMethod = $class->initMethod;
                $class->className = $name;
                if (!isset(self::$sessionData[$name])) {
                    self::$sessionData[$name] = array();
                }
            }

            if (method_exists($class, $class->initMethod)) {
                $methodData = new ReflectionMethod($class, $initMethod);
                if ($methodData->isStatic()) {
                    $class::$initMethod();
                } else {
                    self::$instances[$name]->$initMethod();
                }
            }
        }
        return self::$instances[$name];
    }

    protected function setClassSessionData($key, $val)
    {
        if (empty($val)) {
            self::removeClassSessionData($key);
        } else {
            self::$sessionData[$this->className][$key] = $val;
        }
    }

    protected function removeClassSessionData($key = false)
    {
        if ($key) {
            unset(self::$sessionData[$this->className][$key]);
        } else {
            unset(self::$sessionData[$this->className]);
        }
    }

    protected function removeClassSessionDataWithExclusions($keys)
    {
        foreach (array_keys(self::$sessionData[$this->className]) as $key) {
            if (!in_array($key, $keys)) {
                unset(self::$sessionData[$this->className][$key]);
            }
        }
    }

    protected function &getClassSessionReference()
    {
        return self::$sessionData[$this->className];
    }

    protected function getClassSessionData($key = false)
    {
        if ($key) {
            return self::$sessionData[$this->className][$key] ?? null;
        }
        return self::$sessionData[$this->className];
    }
}