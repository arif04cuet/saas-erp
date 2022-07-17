<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use App\Models\Doptor;
use Maatwebsite\Excel\Concerns\ToArray;

class CreateDoptor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:doptor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync doptor data from dashboard application';

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
     * @return int
     */
    public function handle()
    {
        $api_url = config('services.doptor.doptor_url') . '/organogram/doptors';

        $response = Http::dashboard()->get($api_url);

        $doptors = $response->collect()->map(function ($doptor) {
            return [
                'doptor_id' => $doptor['id'],
                'name_eng' => $doptor['name']['en'],
                'name_bng' => $doptor['name']['bn'],

            ];
        })->toArray();

        Doptor::upsert(
            $doptors,
            ['doptor_id']
        );
    }
}
