<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Debug\Debug;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DepartmentsTableSeeder::class); // required
        $this->call(DesignationsTableSeeder::class); // required
        $this->call(DistrictsTableSeeder::class); // required
        $this->call(DivisionsTableSeeder::class); // required
        $this->call(EconomyCodesTableSeeder::class); // required
        $this->call(EconomyHeadsTableSeeder::class); // required
        $this->call(UsersTableSeeder::class); // required
        $this->call(EmployeesTableSeeder::class); // required
        $this->call(FeaturesTableSeeder::class); // required
        $this->call(HostelBudgetTitlesTableSeeder::class); // required
        $this->call(HostelsTableSeeder::class); // required
        $this->call(InventoriesTableSeeder::class); // required
        $this->call(InventoryHistoriesTableSeeder::class); // required
        $this->call(InventoryItemCategoriesTableSeeder::class); // required
        $this->call(InventoryCategoryGroupsTableSeeder::class);
        $this->call(InventoryLocationsTableSeeder::class); // required
        $this->call(NotificationTypesTableSeeder::class); // required
        $this->call(RoleUserTableSeeder::class); // required
        $this->call(RolesTableSeeder::class); // required
        $this->call(RoomTypesTableSeeder::class); // required
        $this->call(RoomsTableSeeder::class); // required
        $this->call(ShareRulesTableSeeder::class); // required
        $this->call(ShareRulesDesignationsTableSeeder::class); // required
        $this->call(ThanasTableSeeder::class); // required
        $this->call(UnionsTableSeeder::class); // required
        $this->call(WorkflowRuleDetailsTableSeeder::class); // required
        $this->call(WorkflowRuleMastersTableSeeder::class); // required
        $this->call(LeaveTypesTableSeeder::class); // required
        $this->call(AssessmentQuestionTableSeeder::class); // required
        $this->call(NotesTypeTableSeeder::class); // required
        $this->call(UpazilasTableSeeder::class); // required
        $this->call(AppraisalContentsSeeder::class); // required
        $this->call(DesignationRanksSeeder::class); // required
        $this->call(SectionsTableSeeder::class);
        $this->call(AcademicInstitutesTableSeeder::class); // required
        $this->call(LeaveTypePurposesTableSeeder::class); // required
        $this->call(TrainingParticipantTypesSeeder::class); // required
        $this->call(TrainingCategoriesTableSeeder::class); // required
        $this->call(TrainingVenuesTableSeeder::class); // required
        $this->call(TrainingCafeteriasTableSeeder::class); // required
        //$this->call(RevenueBudgetTableSeeder::class); // temp-required for accounts
        $this->call(FiscalYearsTableSeeder::class); // temp-required for accounts
        $this->call(AccountsDatabaseSeeder::class); // required for accounts
        //$this->call(RevenueBudgetDetailTableSeeder::class);  // temp-required for accounts
        //Journal related seeders
        /*
         * Seeder placed in AccountsDatabaseSeeder
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
        $this->call(EmployeeContractsTableSeeder::class);  // temp-required for accounts-payroll
        $this->call(EmployeeContractAssignedRulesTableSeeder::class); // temp-required for accounts-payroll
        $this->call(MasterRollEmployeeTableSeeder::class); // temp-required for accounts-payroll
        // GPF Related Seeder
        $this->call(GpfHistoriesTableSeeder::class); // temp-required for accounts-payroll
        $this->call(GpfRecordsTableSeeder::class);
        $this->call(GpfConfigurationsTableSeeder::class);
        $this->call(SalaryRuleChildrenTableSeeder::class);   // required for accounts-payroll
        $this->call(PostRetirementLeaveEmployeeTableSeeder::class); // required for accounts-payroll
        $this->call(PensionConfigurationTableSeeder::class); // required for accounts-pension
        $this->call(PensionRuleTableSeeder::class); // required for accounts-pension
        // Accounts Budget Related Seeder
        $this->call(EconomySectorsTableSeeder::class);
        $this->call(AccountsBudgetsTableSeeder::class); // required
        $this->call(AccountsBudgetSectorsTableSeeder::class); // required
        $this->call(EmployeeReligionsTableSeeder::class); // required
        */
        // employee related other tables
        $this->call(EmployeeSpouseChildrenInfosTableSeeder::class);
        $this->call(EmployeeEducationsTableSeeder::class);
        $this->call(EmployeePublicationsTableSeeder::class);
        $this->call(EmployeeTrainingsTableSeeder::class);
        $this->call(EmployeeResearchInfoTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(RawMaterialsTableSeeder::class);
        $this->call(PurchaseListsTableSeeder::class);
        $this->call(PurchaseItemListsTableSeeder::class);
        $this->call(CafeteriaInventoriesTableSeeder::class);
        $this->call(CafeteriaInventoryTransactionsTableSeeder::class);
        $this->call(UnitPricesTableSeeder::class);
        $this->call(FoodMenusTableSeeder::class);
        $this->call(FoodMenuItemsTableSeeder::class);

        // Annual Training Notification Related Seeder
        $this->call(AnnualTrainingNotificationsTableSeeder::class);
        $this->call(AnnualTrainingNotificationOrganizationsTableSeeder::class);
        $this->call(AnnualTrainingNotificationResponsesTableSeeder::class);

        // TMS Accounts related seeder
        $this->call(TmsAccountBalancesTableSeeder::class);
        $this->call(TmsAdvancePaymentsTableSeeder::class);
        $this->call(TmsBudgetSectorsTableSeeder::class);
        $this->call(TmsBudgetsTableSeeder::class);
        $this->call(TmsCashBookEntriesTableSeeder::class);
        $this->call(TmsJournalEntriesTableSeeder::class);
        $this->call(TmsSectorsTableSeeder::class);
        $this->call(TmsSubSectorsTableSeeder::class);

        // Vms Related Seeder
        $this->call(VmsDatabaseSeeder::class);
        // user seed for ESO, SO
//        DB::table('users')->insert(
//            array(
//                0 =>
//                    array(
//                        'id'                   => 54,
//                        'name'                 => 'Estate Come Store Officer',
//                        'email'                => 'eso@bard.com',
//                        'email_verified_at'    => null,
//                        'password'             => bcrypt('123123'),
//                        'remember_token'       => null,
//                        'username'             => 'ESO',
//                        'user_type'            => 'Employee',
//                        'mobile'               => '01711111111',
//                        'reference_table_id'   => 54,
//                        'status'               => 'Active',
//                        'last_password_change' => '2019-05-29 10:42:31',
//                    ),
//                1 =>
//                    array(
//                        'id'                   => 55,
//                        'name'                 => 'Store Keeper',
//                        'email'                => 'sto@bard.com',
//                        'email_verified_at'    => null,
//                        'password'             => bcrypt('123123'),
//                        'remember_token'       => null,
//                        'username'             => 'STO',
//                        'user_type'            => 'Employee',
//                        'mobile'               => '01711111111',
//                        'reference_table_id'   => 55,
//                        'status'               => 'Active',
//                        'last_password_change' => '2019-05-29 10:42:31'
//                    )
//            )
//        );
        $now = \Carbon\Carbon::now();
        // Employee seed for ESO, STO
//        DB::table('employees')->insert(
//            array(
//                0 =>
//                    array(
//                        'id'                     => 54,
//                        'employee_id'            => 'ESO',
//                        'first_name'             => 'Estate Come',
//                        'last_name'              => 'Store Officer',
//                        'photo'                  => null,
//                        'email'                  => 'eso@bard.com',
//                        'gender'                 => 'male',
//                        'department_id'          => 9,
//                        'designation_id'         => '54',
//                        'is_divisional_director' => 0,
//                        'status'                 => 'present',
//                        'tel_office'             => null,
//                        'tel_home'               => null,
//                        'mobile_one'             => '01711111111',
//                        'mobile_two'             => null,
//                        'created_at'             => $now,
//                        'updated_at'             => '2019-05-29 10:42:31',
//                        'deleted_at'             => null,
//                    ),
//                1 =>
//                    array(
//                        'id'                     => 55,
//                        'employee_id'            => 'STO',
//                        'first_name'             => 'Store',
//                        'last_name'              => 'Keeper',
//                        'photo'                  => null,
//                        'email'                  => 'sto@bard.com',
//                        'gender'                 => 'Male',
//                        'department_id'          => 9,
//                        'designation_id'         => '55',
//                        'is_divisional_director' => 0,
//                        'status'                 => 'present',
//                        'tel_office'             => null,
//                        'tel_home'               => null,
//                        'mobile_one'             => '01711111112',
//                        'mobile_two'             => null,
//                        'created_at'             => $now,
//                        'updated_at'             => null,
//                        'deleted_at'             => null,
//                    )
//            )
//        );
        // ims permissions
        $adminUserNames = ['directoradmin', 'eso', 'sto', 'directorgeneral'];
        $storeSectionUserNames = ['eso', 'sto'];
        $deptHeads = ['dirr', 'directoradmin', 'milankantibard'];
        $usersWhoCanReject = array_merge($deptHeads, $adminUserNames);
        $users = \App\Entities\User::all();
        $users->each(function ($user) use ($adminUserNames, $usersWhoCanReject, $deptHeads, $storeSectionUserNames) {
            $this->assignShareRole($user);
            $this->assignDeptHeadRole($user, $deptHeads);
            $this->assignRejectRole($user, $usersWhoCanReject);
            $this->assignApproveReceiveRole($user, $adminUserNames);
            $this->assignInventorySectionUserRole($user, $storeSectionUserNames);
            $this->assignFacultyRole($user);


        });
        // academic institutes & education boards seeder
        $academicInstitutes = [
            ['name' => 'National Institute 1', 'type' => 'university', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'National Institute 2', 'type' => 'university', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'National Institute 3', 'type' => 'university', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'National Institute 4', 'type' => 'university', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'National Institute 5', 'type' => 'university', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'National Institute 6', 'type' => 'university', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dhaka', 'type' => 'board', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rajshahi', 'type' => 'board', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cumilla', 'type' => 'board', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jessore', 'type' => 'board', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chattogram', 'type' => 'board', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Barisal', 'type' => 'board', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sylhet', 'type' => 'board', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dinajpur', 'type' => 'board', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Madrasah', 'type' => 'board', 'created_at' => now(), 'updated_at' => now()],
        ];
        $this->seedAcademicInstitutes($academicInstitutes);
    }

    /**
     * @param $user
     */
    private function assignShareRole($user): void
    {
        \Illuminate\Support\Facades\DB::table('role_user')->insert([
            'role_id' => 10, // ROLE_INVENTORY_REQUEST_SHARE,
            'user_id' => $user->id
        ]);
    }

    /**
     * @param $user
     * @param $deptHeads
     */
    private function assignDeptHeadRole($user, $deptHeads): void
    {
        if (in_array(strtolower($user->username), $deptHeads)) {
            \Illuminate\Support\Facades\DB::table('role_user')->insert([
                'role_id' => 9, // ROLE_DEPARTMENT_HEAD,
                'user_id' => $user->id
            ]);
        }
    }

    /**
     * @param $user
     * @param $usersWhoCanReject
     */
    private function assignRejectRole($user, $usersWhoCanReject): void
    {
        if (in_array(strtolower($user->username), $usersWhoCanReject)) {
            \Illuminate\Support\Facades\DB::table('role_user')->insert([
                'role_id' => 12, // ROLE_INVENTORY_REQUEST_REJECT,
                'user_id' => $user->id
            ]);
        }
    }

    /**
     * @param $user
     * @param $adminUserNames
     */
    private function assignApproveReceiveRole($user, $adminUserNames): void
    {
        if ($user->getDepartmentCode() == \App\Constants\DepartmentShortName::InventoryDivision
            && in_array(strtolower($user->username), $adminUserNames)
        ) {

            \Illuminate\Support\Facades\DB::table('role_user')->insert([
                [
                    'role_id' => 11, // ROLE_INVENTORY_REQUEST_APPROVE,
                    'user_id' => $user->id
                ],
                [
                    'role_id' => 13, // ROLE_INVENTORY_REQUEST_RECEIVE,
                    'user_id' => $user->id
                ]
            ]);
        }
    }

    private function assignInventorySectionUserRole($user, $storeSectionUserNames): void
    {
        if (in_array(strtolower($user->username), $storeSectionUserNames)) {

            \Illuminate\Support\Facades\DB::table('role_user')->insert([
                [
                    'role_id' => 14, // ROLE_INVENTORY_USER,
                    'user_id' => $user->id
                ]
            ]);

        }
    }

    private function assignFacultyRole($user): void
    {
        if (!$user->hasAnyRole(['ROLE_FACULTY'])) {
            \Illuminate\Support\Facades\DB::table('role_user')->insert([
                [
                    'role_id' => 6,
                    'user_id' => $user->id
                ]
            ]);
        }
    }

    private function seedAcademicInstitutes($academicInsitutes = [])
    {
        DB::table('academic_institutes')->truncate();
        DB::table('academic_institutes')->insert($academicInsitutes);
    }
}
