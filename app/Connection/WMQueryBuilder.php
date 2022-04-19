<?php

namespace App\Connection;

use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use PDO;

/**
 * @method WMMysqlConnection getConnection()
 * @property WMMysqlConnection $connection (PROTECTED)
 * @method static string toRawSql() (macro in AppServiceProvider, debug helper)
 */
class WMQueryBuilder extends Builder
{

    private $fetchMode = 0;

    public function setFetchMode(int $fetchMode, $additional = null): self
    {
        $this->connection->setFetchMode($fetchMode, $additional);
        return $this;
    }

    /**
     * @param array $columns
     * @return array
     *
     * @like (at default fetch mode, when fetch mode is edited results will be very different)
     * [
     *  stdClass{"ID"=>1, "NAME"=>"asd"},
     *  stdClass{"ID"=>2, "NAME"=>"dsa"},
     * ]
     */
    //copy of Illuminate\Database\Query\Builder -> get() method
    // -> without call collect on return
    // -> reset changed fetch modes settings at the end
    private function getResultsArray(array $columns = ['*']): array
    {
        $data = $this->onceWithColumns(Arr::wrap($columns), function () {
            return $this->processor->processSelect($this, $this->runSelect());
        });
        $this->_resetFetchMode();
        return $data;
    }

    private function _resetFetchMode(): void
    {
        $this->fetchMode = 0;
        $this->connection->resetFetchMode();
    }

    private function _getFetchModes(array $additionalModes = []): int
    {
        foreach ($additionalModes as $k => $v) {
            $this->fetchMode |= $v;
        }
        if ($this->fetchMode === 0) {
            $this->fetchMode = $this->connection->getFetchMode();
        }
        return $this->fetchMode;
    }

    //<editor-fold desc="reader methods with variable fetch modes implemented">
    /**
     * @param $column (number or full name as it found in select list)
     * @return array
     * @throws Exception
     *
     * @like [ "var1", "var2" ]
     *
     */
    public function getSingleList($column): array
    {
        if (($field = is_numeric($column) ? $column : array_search($column, $this->columns, true)) === false) {
            throw new Exception("$column not found");
        }
        return $this->setFetchMode($this->_getFetchModes([PDO::FETCH_COLUMN]), $field)->getResultsArray();
    }

    /**
     * @param array $columns
     * @return array
     *
     * @like
     * [
     *  ["ID"=>1, "NAME"=>"asd"],
     *  ["ID"=>2, "NAME"=>"dsa"],
     * ]
     */
    public function getArray(array $columns = ['*']): array
    {
        return $this->setFetchMode($this->_getFetchModes([PDO::FETCH_ASSOC]))->getResultsArray($columns);
    }

    /**
     * @param string $class
     * @param array|null $constructorArgs
     * @return array
     *
     * @like
     * [
     *  anySelectedClass{"ID"=>1, "NAME"=>"asd"},
     *  anySelectedClass{"ID"=>2, "NAME"=>"dsa"},
     * ]
     */
    public function getAsClass(string $class = "stdClass", ?array $constructorArgs = null): array
    {
        return $this
            ->setFetchMode($this->_getFetchModes([PDO::FETCH_CLASS, PDO::FETCH_PROPS_LATE]), $class, $constructorArgs)
            ->getResultsArray();
    }

    /**
     * @param callable $callback
     * @return array
     */
    public function getViaMethod(callable $callback): array
    {
        return $this->setFetchMode($this->_getFetchModes([PDO::FETCH_FUNC]), $callback)->getResultsArray();
    }

    /**
     * @return array
     *
     * @like
     * [
     *  "col1 value 1"=> "col2 value 1",
     *  "col1 value 2"=> "col2 value 2",
     * ]
     *
     */
    public function getKeyPairs(): array
    {
        if (count($this->columns) === 1) {
            $this->addSelect(array_values($this->columns));
        }
        return $this->setFetchMode($this->_getFetchModes([PDO::FETCH_KEY_PAIR]))->getResultsArray();
    }
    //</editor-fold>

    //<editor-fold desc="additional fetch modes defined before get">
    /**
     * group keys will set only if column contains string values
     * @param string|null $columnName
     * @return $this
     */
    public function useGroupFetch(?string $columnName = null): self
    {
        if (!empty($columnName)) {
            if (empty($this->columns)) {
                $this->addSelect($columnName);
            } else {
                array_unshift($this->columns, $columnName);//addSelect to begin
            }
        }
        $this->fetchMode |= PDO::FETCH_GROUP;
        return $this;
    }

    public function useUniqueFetch(): self
    {
        $this->fetchMode |= PDO::FETCH_UNIQUE;
        return $this;
    }

    public function useAssocFetch(): self
    {
        $this->fetchMode |= PDO::FETCH_ASSOC;
        return $this;
    }
    //</editor-fold>

}
