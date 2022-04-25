<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.19.
 * Time: 13:57
 */

namespace App\Repositories;

use App\Models\Jelentkezo;
use App\Models\JelentkezoJog;
use App\Models\Tabor;
use App\Models\User;
use Illuminate\Support\Collection;

/**
 * Class UserRepository
 * @package App\Repositories
 *
 * @method static UserRepository getInstance()
 */
class UserRepository extends MainRepository
{
    /** @var string|User */
    protected $model = User::class;
    protected $initMethod = "LoadData";
    /** @var User */
    protected $user;

    protected function LoadData(): void
    {
        $this->Load();
        $this->user = auth()->user();
    }

    public function getHozzaferhetoTaborok(): Collection
    {
        if ($this->user->isAdmin()) {
            return Tabor::all();
        }
        $tJJ = JelentkezoJog::getTableName();
        $tJ = Jelentkezo::getTableName();
        return $this->user->taborok()->join(
            $tJJ,
            $tJJ . ".ID_jelentkezo",
            "=",
            $tJ . ".ID"
        )->get();
    }
}