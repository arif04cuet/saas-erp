<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class CompareEmployee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'compare:employee';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compare employees between 2 tables';

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
        $reader1 = new Xlsx();
        $file1 = $reader1->setReadEmptyCells(false)->load('public/files/imran.xlsx');
        $data1 = $file1->getActiveSheet();

	$reader2 = new Xlsx();
        $file2 = $reader2->setReadEmptyCells(false)->load('public/files/sohan.xlsx');
        $data2 = $file2->getActiveSheet();

	$reader3 = new Xlsx();
	$file3 = $reader3->setReadEmptyCells(false)->load('public/files/matches.xlsx');
	$data3 = $file3->getActiveSheet();

	$data1 = $data1
            ->toArray(
                null,
                true,
                true,
                true
	);

	$data2 = $data2
            ->toArray(
                null,
                true,
                true,
                true
	);

	$data3 = $data3
		->toArray(
			null,
			true,
			true,
			true	
		);

	foreach($data3 as $key => $datum) {
		$data3[$key]['A'] =  "'" . $datum['A'] . "'";
		$data3[$key]['C'] =  "'" . $datum['C'] . "'";
	}

	print implode(", ", array_column($data3, 'A'));
	print "\n_______\n";
	print implode(", ", array_column($data3, 'C'));
	print "\n";

	dd([]);

	$employeesFromImran = [];
	$employeesFromSohan = [];
	$didNotMatched = [];

	unset($data1[1]);
	unset($data1[2]);

	foreach($data1 as $key => $datum) {
		$dummy = trim(str_replace("জনাব ",  "", $datum['C'])) ;
		//$employeesFromImran[trim(str_replace(["\t"], [""], $datum['C']))] = trim(str_replace("বেগম ", "", $dummyy));
		
		$employeesFromImran[$key] = trim(str_replace("বেগম ", "", $dummy));
	}

	//array_shift($employeesFromImran);

	//dd($employeesFromImran);

	$data = implode(" | ", $employeesFromImran);
	$found = 0;
	$notFound = 0;
	$foundEmployeeIds = [];

	unset($data2[1]);

	foreach($data2 as $key => $datum) {
		//print $datum['B'] . "\n";

		if(is_array($datum) && isset($datum['B'])) {
				
			if(($matched = array_search(trim($datum['C']), $employeesFromImran)) === false) {
				$notFound++;
				$didNotMatched[$datum['A']] = trim($datum['C']);				
			}else {
				if(isset($data1[$matched])) {
				if(!in_array("'" . $data1[$matched]['B'] . "'", $foundEmployeeIds) && !in_array("'" . $datum['B'] . "'", $employeesFromSohan)) {
					//dd($matched, $datum['C']);
					$found++;

					$foundEmployeeIds[] = $data1[$matched]['A'];
					$employeesFromSohan[] = $datum['A'];
				}

				}
			}
		}
	}

	//print_r($foundEmployeeIds);

	//dd([]);


	print "Matched : " . ($found * 100.00) / count($data2) . "\n";
	print "Not matched: " . ($notFound * 100.00) / count($data2) . "\n";
	print "Total Found: " . count($foundEmployeeIds) . "\n";
	//foreach($foundEmployeeIds as $key => $id) {
	//	$foundEmployeeIds[$key] = "'" . $id . "'";
	//}
	
	//foreach($employeesFromSohan as $key => $id) {
	//	$employeesFromSohan[$key] = "'" . $id . "'";
	//}
		
	print implode("\n", $foundEmployeeIds);
	print "\n----------\n";
	print implode("\n", $employeesFromSohan);

	print "total - Imran: " . count($foundEmployeeIds) . " Sohan: " . count($employeesFromSohan) . "\n";
	//foreach($foundEmployeeIds as $id) {
	//	print $id . "\n";
	//}
	//dd($employeesFromImran, $employeesFromSohan, $didNotMatched);
    }
}
