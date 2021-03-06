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

abstract class MainRepository extends Singleton
{
    /**
     * add class name what primary related for repo, later find here its instance
     * @var BaseModel|string $model
     */
    protected $model;

    final protected function Load()
    {
        $this->model = new $this->model;
    }
}