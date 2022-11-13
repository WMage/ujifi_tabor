<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.05.04.
 * Time: 20:46
 */

namespace App\Http\Controllers\AdminTraits;

trait VerzioKezelesTrait
{
    private string $gitRoute = '/home/fokolare/tabor.fokolare.hu';

    public function pull(): void
    {
        $this->gitExec(['reset --hard', 'pull']);
    }

    private function gitExec(array $commands): void
    {
        $results = [];
        foreach ($commands as $k => $command) {
            $results[] = exec('cd ' . $this->gitRoute . ' && git ' . $command);
        }
        dd($results);
    }
}
