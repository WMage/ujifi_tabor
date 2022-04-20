<?php

namespace App;

use App\Models\Jelentkezo;
use App\Repositories\JelentkezoRepository;
use App\Repositories\TaborRepository;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 *
 * --relations
 * @property Jelentkezo jelentkezo
 */
class User extends Authenticatable
{
    private $jogok = [];
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param string $jog
     * @param bool $szerkesztheti
     * @return bool
     * @throws \ReflectionException
     */
    public function hasPerm(string $jog, bool $szerkesztheti): bool
    {
        return ($this->getOsszesJog()[$jog] ?? -1) >= (int)$szerkesztheti;
    }

    /**
     * @return array
     */
    public function getOsszesJog(): array
    {
        $szerepkorJogok = $this->jelentkezo->szerepkor->jogok->pluck("nev","alias")->toArray();
        return $szerepkorJogok;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @throws \ReflectionException
     */
    public function jelentkezo()
    {
        /** @var TaborRepository $taborRepo */
        $taborRepo = TaborRepository::getInstance();
        $taborId = $taborRepo->getKijeloltTaborId() ?: 1;
        return $this->belongsTo(
            Jelentkezo::class,
            "id",
            "ID_user"
        )
            ->where(Jelentkezo::getTableName() . ".ID_tabor", "=", $taborId);
    }
}
