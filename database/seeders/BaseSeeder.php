<?php

namespace Database\Seeders;

use App\Models\BaseModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

abstract class BaseSeeder extends Seeder
{
    final public function run()
    {
        $table = $this->getModel()->getTable();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table($table)->truncate();
        DB::table($table)->insert($this->getValues());
        //DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /** a be insert-álandó értékek tömbje */
    protected abstract function getValues(): array;

    /** a model példánya amihez az értékek tartoznak */
    protected abstract function getModel(): BaseModel;
}
