<?php

namespace App\Models;

use App\Connection\WMQueryBuilder;
use Closure;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * Class BaseModel
 * @package App\Models
 * *
 *
 * @method static Model|Collection|EloquentBuilder|static|null find(int | string | array $id, $columns = ['*'])
 * @method static Model|Collection|EloquentBuilder|static findOrFail(int | array $id, $columns = ['*'])
 * @method static Model|static create(array $array) fillable array
 * @method static bool insert(array $array) fillable array's array
 * @method static void truncate()
 * @method static Collection|EloquentBuilder|static[]|static select(array | string ...$selector) field list
 * @method static Collection|EloquentBuilder|static[]|static selectRaw(string $expression, array $bindings = []) field list
 * @method static EloquentBuilder|static where(string | array | Closure $field, $operator_or_condition = null, $condition = null)
 * @method EloquentBuilder|static orWhere(string | array | Closure $field, $operator_or_condition = null, $condition = null, string $boolean = 'and')
 * @method static EloquentBuilder|static whereIn(string $column, mixed $values, string $boolean = 'and', bool $not = false)
 * @method static QueryBuilder|static whereNull($columns, $boolean = 'and', $not = false)
 * @method static QueryBuilder|static whereNotNull($columns, $boolean = 'and')
 * @method static int max(string $field)
 * @method static EloquentBuilder|static with(...$relations)
 * @method static EloquentBuilder orderBy(string $column, string $direction = 'asc')
 * @method static QueryBuilder|static leftJoin(string $table, Closure | string $first, ?string $operator = null, ?string $second = null)
 * @method static QueryBuilder|static join(string $table, Closure | string $first, ?string $operator = null, ?string $second = null, $type = 'inner', $where = false)
 * @method static \Illuminate\Support\Collection|static[] get($columns = ['*'])
 * @method static Model|static firstOrCreate(array $attributes, array $values = [])
 * @method static EloquentBuilder groupBy(array | string ...$groups)
 * @method WMQueryBuilder getQuery()
 *
 * @method static string toRawSql() (macro in AppServiceProvider, debug helper)
 * @method static array getAsSimpleArray(string $column, ?string $key = null) macro in AppServiceProvider, to speed up revive query values if possible
 *
 * @mixin EloquentBuilder
 * @mixin QueryBuilder
 *
 */
class BaseModel extends Model
{
    protected $primaryKey = "ID";
    public $timestamps = false;

    public static function getTableName(): string
    {
        return (new static)->getTable();
    }

    public function fill($attributes)
    {
        foreach ($attributes as $k => $v) {
            if ($v == 'null') {
                $attributes[$k] = null;
            }
        }
        return parent::fill($attributes);
    }
}