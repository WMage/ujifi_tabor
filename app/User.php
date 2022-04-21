<?php

namespace App;

use App\Models\Jelentkezo;
use App\Models\Jog;
use App\Repositories\TaborRepository;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

/**
 * Class User
 * @package App
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|string $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property int $access_level
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 *
 * --relations
 * @property Jelentkezo jelentkezo
 */
class User extends Authenticatable
{
    use Notifiable;
    private $jogok = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'access_level'
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
        'access_level' => 'int',
    ];

    public function isAdmin(): bool
    {
        return $this->access_level > 1;
    }

    public function isReader(): bool
    {
        return $this->access_level > 0;
    }

    /**
     * @param string $jog
     * @param bool $szerkesztheti
     * @return bool
     * @throws \ReflectionException
     */
    public function hasPerm(string $jog, bool $szerkesztheti): bool
    {
        $vanJog = false;
        $vanJog =
            $this->isAdmin() ||
            (!$szerkesztheti && $this->isReader())
            (($vanJog = ($this->getOsszesJog()[$jog] ?? (new Jog()))->szerkesztheti) === $szerkesztheti) ||
            $vanJog;
        if ($vanJog && $szerkesztheti && (TaborRepository::getInstance()->getKijeloltTabor()->lezarult())) {
            return $this->isAdmin();
        }
        return $vanJog;
    }

    /**
     * @return array
     */
    public function getOsszesJog(): array
    {
        if (empty($this->jogok)) {
            $szerepkorJogok = $this->jelentkezo->szerepkor->jogok;
            $jelentkezoJogok = $this->jelentkezo->jogok;
            foreach ($szerepkorJogok as $k => $jog) {
                $this->jogok[$jog->alias] = $jog;
            }
            foreach ($jelentkezoJogok as $k => $jog) {
                $this->jogok[$jog->alias] = $jog;
            }
        }
        return $this->jogok;
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
