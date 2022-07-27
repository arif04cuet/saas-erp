<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProjectBoostrap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:bootstrap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bootstrap Project by adding superadmin, doptors, modules';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Creating Super admin');
        $this->call('db:seed', ['class' => 'SuperAdminUserSeeder']);
        $this->info('Super admin created successfully');
        $this->info('Importing Doptors');
        $this->call('sync:doptor');
        $this->info('Importing Doptors - done');
        $this->call('db:seed', ['class' => 'ImportModulesSeeder']);
        $this->info('Importing Modules - done');
        $this->call('db:seed', ['class' => 'LeaveTypesTableSeeder']);
    }
}
