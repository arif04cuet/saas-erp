<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InverseSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:inverse {--force} {--clean}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Seeder of existing data from database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('iseed', $this->getArguments());
    }

    private function getTableNames()
    {
        $tableNamesContainer = DB::select('show tables');
        $tableNamesArray = [];

        foreach ($tableNamesContainer as $index => $tableNames) {
            foreach ($tableNames as $tableName) {
                $tableName != "migrations" ? array_push($tableNamesArray, $tableName) : false;
            }
        }

        return implode(',', $tableNamesArray);
    }

    protected function getArguments(): array
    {
        $arguments = ['tables' => $this->getTableNames()];

        $this->option('force') ? $arguments['--force'] = true : null;
        $this->option('clean') ? $arguments['--clean'] = true : null;

        return $arguments;
    }
}
