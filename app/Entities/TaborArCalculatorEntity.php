<?php

namespace App\Entities;

use App\Models\KedvezmenyesDatum;
use App\Models\TaborAr;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TaborArCalculatorEntity
{
    private Collection $collection;
    private static array $instances = [];

    public static function getInstance(int $taborId): self
    {
        if (!isset(self::$instances[$taborId])) {
            self::$instances[$taborId] = new self($taborId);
        }
        return self::$instances[$taborId];
    }

    private function __construct(int $taborId)
    {
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
        return
            $this->vanReggeli()
            ||
            $this->vanTizorai()
            ||
            $this->vanEbed()
            ||
            $this->vanUzsonna()
            ||
            $this->vanVacsora();
    }

    public function vanSzallas(): bool
    {
        return $this->collection->contains('AR_szallas', '!==', null);
    }
}
