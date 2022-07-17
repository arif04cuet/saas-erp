<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Accounts\Entities\EconomyCode;
use Modules\Accounts\Entities\EconomyHead;
use Modules\Accounts\Imports\ImportEconomicCode;

class AccountsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Journal related seeders
        $this->call(JournalTypeTableSeeder::class);  // required for accounts-journal-type
        $this->call(JournalTableSeeder::class);  // required for accounts-journal
        $this->call(JournalEntryTableSeeder::class);  // required for accounts-journal
        //payroll related seeders
        $this->call(SalaryCategoriesTableSeeder::class); // temp-required for accounts-payroll
        $this->call(SalaryBasicsTableSeeder::class); // temp-required for accounts-payroll
        $this->call(SalaryRulesTableSeeder::class); // temp-required for accounts-payroll
        $this->call(PayscalesTableSeeder::class); // temp-required for accounts-payroll
        $this->call(SalaryStructuresTableSeeder::class); // temp-required for accounts-payroll
        $this->call(SalaryStructureRulesTableSeeder::class); // temp-required for accounts-payroll
        //$this->call(EmployeeContractsTableSeeder::class);  // temp-required for accounts-payroll
        //$this->call(EmployeeContractAssignedRulesTableSeeder::class); // temp-required for accounts-payroll
        //$this->call(MasterRollEmployeeTableSeeder::class); // temp-required for accounts-payroll
        // GPF Related Seeder
        #$this->call(GpfHistoriesTableSeeder::class); // temp-required for accounts-payroll
        $this->call(GpfRecordsTableSeeder::class);
        $this->call(GpfConfigurationsTableSeeder::class);
        //$this->call(EmployeePersonalInfoTableSeeder::class); // required for accounts-payroll for EA, And Order by Joining Date
        $this->call(SalaryRuleChildrenTableSeeder::class);   // required for accounts-payroll
        //$this->call(PostRetirementLeaveEmployeeTableSeeder::class); // required for accounts-payroll
        $this->call(PensionConfigurationTableSeeder::class); // required for accounts-pension
        $this->call(PensionRuleTableSeeder::class); // required for accounts-pension
        // Accounts Budget Related Seeder
        $this->call(EconomySectorsTableSeeder::class);
        $this->call(AccountsBudgetsTableSeeder::class); // required
        $this->call(AccountsBudgetSectorsTableSeeder::class); // required
        //$this->call(EmployeeReligionsTableSeeder::class); // required
    }
}
