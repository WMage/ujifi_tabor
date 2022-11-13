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
use Illuminate\Support\Facades\Hash;
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
    protected $model = User::class;
    protected string $initMethod = "loadData";
    protected ?User $user;

    protected function loadData(): void
    {
        $this->load();
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

    public function getOrRegister(string $email, string $nev, string $szuletesnap, ?bool &$uj = null): User
    {
        $user = User::where('email', '=', $email)->first();
        if ($uj = ($user === null)) {
            $nev = Str::slug($nev);
            $user = User::create([
                'email' => $email,
                'name' => $nev,
                'password' => Hash::make($nev . ' ' . $szuletesnap),
                'api_token' => Str::random(60),
            ]);
            //TODO: megerősítő email küldése
        }
        return $user;
    }
}
