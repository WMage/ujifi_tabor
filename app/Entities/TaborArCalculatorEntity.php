<?php

namespace App\Entities;

use App\Models\Jelentkezo;
use App\Models\KedvezmenyesDatum;
use App\Models\TaborAr;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TaborArCalculatorEntity
{
    private Collection $collection;
    private int $taborId;
    private Jelentkezo $jelentkezo;
    private static array $instances = [];

    private const ETKEZES_MEZOK = ['reggeli', 'tizorai', 'ebed', 'uzsonna', 'vacsora'];

    public static function getInstance(int $taborId, ?int $jelentkezoId = null): self
    {
        $key = $taborId . ((string)$jelentkezoId);
        if (!isset(self::$instances[$key])) {
            self::$instances[$key] = new self($taborId, $jelentkezoId);
        }
        return self::$instances[$key];
    }

    private function __construct(int $taborId, ?int $jelentkezoId = null)
    {
        $this->taborId = $taborId;
        if ($jelentkezoId !== null) {
            $this->jelentkezo = Jelentkezo::with('napok')->findOrFail($jelentkezoId);
        }
        $kdTabla = KedvezmenyesDatum::getTableName();
        $taTabla = TaborAr::getTableName();
        /*$nTabla = Napok::getTableName();*/
        $this->collection = TaborAr::leftJoin($kdTabla, $taTabla . '.ID_kedvdatum', '=', $kdTabla . '.ID')
            /*->join($nTabla, $taTabla . '.ID_tabor', '=', $nTabla . '.ID_tabor')*/
            ->where(function (Builder $query) use ($kdTabla) {
                return $query->whereNull($kdTabla . '.datum')
                    ->orWhere($kdTabla . '.datum', '>=', DB::raw('now()'));
            })
            ->where($taTabla . '.ID_tabor', '=', $taborId)
            ->select([$taTabla . '.*', $kdTabla . '.datum', $kdTabla . '.merteke'])
            ->get();
    }

    public function getCollection(): Collection
    {
        return $this->collection;
    }

    public function vanReggeli(): bool
    {
        return $this->collection->contains('AR_reggeli', '!==', null);
    }

    public function vanTizorai(): bool
    {
        return $this->collection->contains('AR_tizorai', '!==', null);
    }

    public function vanEbed(): bool
    {
        return $this->collection->contains('AR_ebed', '!==', null);
    }

    public function vanUzsonna(): bool
    {
        return $this->collection->contains('AR_uzsonna', '!==', null);
    }

    public function vanVacsora(): bool
    {
        return $this->collection->contains('AR_vacsora', '!==', null);
    }

    public function vanEtkezes(): bool
    {
        foreach(self::ETKEZES_MEZOK as $etkezes){
            $method = 'van'.ucfirst($etkezes);
            if($this->$method()){
                return true;
            }
        }
        return false;
    }

    public function vanSzallas(): bool
    {
        return $this->collection->contains('AR_szallas', '!==', null);
    }

    public function masikJelentkezo(int $jelentkezoId): self
    {
        return self::getInstance($this->taborId, $jelentkezoId);
    }

    public function getEtkezesAr(): int
    {
        foreach ($this->jelentkezo->napok as $nap) {
            $äsd = 1;
        }
        return 0;
    }
}
