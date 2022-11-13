<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.19.
 * Time: 13:57
 */

namespace App\Repositories;

use App\Models\Szerepkor;

class SzerepkorRepository extends MainRepository
{
    /** @var string|Szerepkor */
    protected string $model = Szerepkor::class;

}
