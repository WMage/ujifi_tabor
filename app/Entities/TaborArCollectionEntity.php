<?php

namespace App\Entities;

use App\Models\KedvezmenyesDatum;
use App\Models\TaborAr;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TaborArCollectionEntity
{
    private Collection $collection;

    public function __construct(int $taborId)
    {
        $kdTabla = KedvezmenyesDatum::getTableName();
        $taTabla = TaborAr::getTableName();
        $this->collection = TaborAr::leftJoin($kdTabla, $taTabla . '.ID_kedvdatum', '=', $kdTabla . '.ID')
            ->where(function (Builder $query) use ($kdTabla) {
                return $query->whereNull($kdTabla . '.datum')
                    ->orWhere($kdTabla . '.datum', '>=', DB::raw('now()'));
            })
            ->where($taTabla.'.ID_tabor', '=', $taborId)
            ->select($kdTabla . '.*')
            ->get();
    }

    public function getCollection(): Collection
    {
        return $this->collection;
    }

    public function vanReggeli(): bool
    {
        return $this->collection->contains('AR_reggeli', '>', 0);
    }

    public function vanTizorai(): bool
    {
        return $this->collection->contains('AR_tizorai', '>', 0);
    }

    public function vanEbed(): bool
    {
        return $this->collection->contains('AR_ebed', '>', 0);
    }

    public function vanUzsonna(): bool
    {
        return $this->collection->contains('AR_uzsonna', '>', 0);
    }

    public function vanVacsora(): bool
    {
        return $this->collection->contains('AR_vacsora', '>', 0);
    }
}
