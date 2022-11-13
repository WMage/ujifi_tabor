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
use Illuminate\Support\Str;

/**
 * Class UserRepository
 * @package App\Repositories
 *
 * @method static UserRepository getInstance()
 */
class UserRepository extends MainRepository
{
    /** @var string|User */
    protected string $model = User::class;
    protected string $initMethod = "loadData";
    protected User $user;

    protected function loadData(): void
    {
        $this->load();
        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
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

    public function getOrRegister(string $email, string $nev, ?bool &$uj = null): User
    {
        $user = User::where('email', '=', $email)->first();
        if ($uj = ($user === null)) {
            $user = User::create([
                'email' => $email,
                'name' => Str::slug($nev),
            ]);
            //TODO: jelszó hozzáadása és megerősítő email küldése
        }
        return $user;
    }
}
