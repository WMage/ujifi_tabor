<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.19.
 * Time: 13:57
 */

namespace App\Repositories;

use App\Models\BaseModel;
use App\Service\Singleton;

/**
 * Class MainRepository
 * @package App\Repositories
 *
 * @mixin BaseModel
 */
abstract class MainRepository extends Singleton
{
    /**
     * add class name what primary related for repo, later find here its instance
     * @var BaseModel|string $model
     */
    protected $model;

    final protected function load()
    {
        $this->model = (new $this->model());
    }

    final public function getModel()
    {
        return $this->model;
    }

    public function __call($name, $arguments)
    {
        //dd($name, static::class, $this->)
        return $this->model->$name(...$arguments);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws \ReflectionException
     */
    public static function __callStatic($name, $arguments)
    {
        return static::getInstance()->getModel()::$name(...$arguments);
    }
}
