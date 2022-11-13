<?php

namespace App\Models;

use App\Exceptions\Kiirathato\ErvenytelenJogException;
use App\Exceptions\Kiirathato\OlvasasiJogHianyzikException;
use App\Exceptions\Kiirathato\SzerkesztesiJogHianyzikException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Repositories\TaborRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|string $email_verified_at
 * @property string $password
 * @property string $api_token
 * @property string $remember_token
 * @property int $access_level
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 *
 * --relations
 * @property Jelentkezo jelentkezo
 * @property Collection|Tabor[] taborok
 *
 * @mixin BaseModel
 */
class User extends Authenticatable
{
    /**
     * Client ID: 1
     * Client secret: 8IDl23czllNkv4ASqHOqTwreIp55IoDhLEfOInD8
     * Password grant client created successfully.
     * Client ID: 2
     * Client secret: qI57fOWK9inv6HXauu4Lu7P7Depi5nAXVk47j5yz
     */
    use HasFactory, Notifiable, HasApiTokens;
    private array $jogok = [];

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
     * @param bool $throwsException
     * @return bool
     * @throws ErvenytelenJogException
     * @throws OlvasasiJogHianyzikException
     * @throws SzerkesztesiJogHianyzikException
     * @throws \ReflectionException
     */
    public function hasPerm(string $jog, bool $throwsException = true): bool
    {
        $permParts = explode('.', $jog);
        if ($permParts[0] === "szerkeszt") {
            $userCan = $this->isAdmin();
            $exception = new SzerkesztesiJogHianyzikException($jog);
        } elseif ($permParts[0] === "megtekint") {
            $userCan = $this->isReader();
            $exception = new OlvasasiJogHianyzikException($jog);
        } else {
            //érvénytelen jog
            if ($throwsException) {
                throw new ErvenytelenJogException($jog);
            }
            return false;
        }
        $vanJog = $userCan || ($vanJog = (array_key_exists($jog, $this->getOsszesJog())));
        if ($vanJog && (TaborRepository::getInstance()->getKijeloltTabor()->lezarult())) {
            if ($throwsException && !$userCan) {
                throw $exception;
            }
            return $userCan;
        }

        if ($throwsException && !$vanJog) {
            throw $exception;
        }
        return $vanJog;
    }

    /**
     * @return array
     */
    public function getOsszesJog(): array
    {
        if (empty($this->jogok)) {
            $szerepkor = $this->jelentkezo->szerepkor;
            $szerepkorJogok = $szerepkor ? $szerepkor->jogok : [];
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

    public function taborok()
    {
        return $this->hasManyThrough(
            Tabor::class,
            Jelentkezo::class,
            "ID_user",
            "ID",
            "id",
            "ID_tabor"
        );
    }
}
