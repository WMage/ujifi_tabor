<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.19.
 * Time: 13:57
 */

namespace App\Repositories;

use App\Models\Napok;
use Illuminate\Support\Collection;

/**
 * Class NapokRepository
 * @package App\Repositories
 *
 * @method static NapokRepository getInstance()
 */
class NapokRepository extends MainRepository
{
    /** @var string|Napok */
    protected string $model = Napok::class;

    public function getTaborNapok(int $taborId): Collection
    {
        return $this->model::where('ID_tabor', '=', $taborId)
            ->orderBy('datum')
            ->get();
    }

}
