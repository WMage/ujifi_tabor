<?php

namespace App\Connection;

use Illuminate\Database\Events\StatementPrepared;
use Illuminate\Database\MySqlConnection;
use PDO;
use PDOStatement;

/**
 */
class WMMysqlConnection extends MySqlConnection
{
    private const DEFAULT_FETCH_MODE = PDO::FETCH_OBJ;
    /** @var mixed */
    private $additionalFetchParam = null;//not always in use (eg used at FETCH_COLUMN)

    /*public function __construct($pdo, $database = '', $tablePrefix = '', array $config = [])
    {
        $this->fetchMode = $config["fetch_mode"] ?? self::DEFAULT_FETCH_MODE;
        parent::__construct($pdo, $database, $tablePrefix, $config);
    }*/

    public function getFetchMode(): int
    {
        return $this->fetchMode;
    }

    public function setFetchMode(int $fetchMode, $additionalParam = null): self
    {
        $this->fetchMode = $fetchMode;
        $this->additionalFetchParam = $additionalParam;
        return $this;
    }

    //method body copy from Illuminate\Database\Connection.php
    // except return $statement->fetchAll here receives the supported fetchMode params
    public function select($query, $bindings = [], $useReadPdo = true)
    {
        return $this->run($query, $bindings, function ($query, $bindings) use ($useReadPdo) {
            if ($this->pretending()) {
                return [];
            }

            // For select statements, we'll simply execute the query and return an array
            // of the database result set. Each element in the array will be a single
            // row from the database table, and will either be an array or objects.
            $statement = $this->prepared(
                $this->getPdoForSelect($useReadPdo)->prepare($query)
            );

            $this->bindValues($statement, $this->prepareBindings($bindings));

            $statement->execute();

            if (is_null($this->additionalFetchParam)) {
                return $statement->fetchAll($this->fetchMode);
            }
            return $statement->fetchAll($this->fetchMode, $this->additionalFetchParam);
        });
    }

    protected function prepared(PDOStatement $statement): PDOStatement
    {
        if (!is_null($this->additionalFetchParam)) {
            $statement->setFetchMode($this->fetchMode, $this->additionalFetchParam);
        } else {
            $statement->setFetchMode($this->fetchMode);
        }

        $this->event(new StatementPrepared(
            $this, $statement
        ));

        return $statement;
    }

    public function query()
    {
        return new WMQueryBuilder(
            $this, $this->getQueryGrammar(), $this->getPostProcessor()
        );
    }

    public function resetFetchMode(): self
    {
        $this->setFetchMode(self::DEFAULT_FETCH_MODE);
        return $this;
    }
}
