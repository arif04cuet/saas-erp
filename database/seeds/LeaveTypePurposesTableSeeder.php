<?php

use Illuminate\Database\Seeder;
use Modules\HRM\Constants\LeaveTypes;
use Modules\HRM\Entities\LeaveType;
use Modules\HRM\Entities\LeaveTypePurpose;

class LeaveTypePurposesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('leave_type_purposes')->delete();

        LeaveType::where('name', LeaveTypes::AverageSalaryEarnedLeave)
            ->first()
            ->purposes()
            ->saveMany([
                new LeaveTypePurpose(['name' => 'health']),
                new LeaveTypePurpose(['name' => 'personal']),
            ]);

        LeaveType::where('name', LeaveTypes::HalfAverageSalaryEarnedLeave)
            ->first()
            ->purposes()
            ->saveMany([
                new LeaveTypePurpose(['name' => 'health']),
                new LeaveTypePurpose(['name' => 'personal']),
            ]);

        LeaveType::where('name', LeaveTypes::ExtraordinaryLeave)
            ->first()
            ->purposes()
            ->saveMany([
                new LeaveTypePurpose(['name' => 'health']),
                new LeaveTypePurpose(['name' => 'personal']),
                new LeaveTypePurpose(['name' => 'study']),
            ]);

        LeaveType::where('name', LeaveTypes::StudyLeave)
            ->first()
            ->purposes()
            ->saveMany([
                new LeaveTypePurpose(['name' => 'scientific_and_technical_education']),
            ]);

        LeaveType::where('name', LeaveTypes::QuarantineLeave)
            ->first()
            ->purposes()
            ->saveMany([
                new LeaveTypePurpose(['name' => 'health_(infectious_diseases)']),
            ]);

        LeaveType::where('name', LeaveTypes::NotDueLeave)
            ->first()
            ->purposes()
            ->saveMany([
                new LeaveTypePurpose(['name' => 'health']),
                new LeaveTypePurpose(['name' => 'personal']),
            ]);

        // LeaveType::where('name', LeaveTypes::PublicAndGovtLeave)
        //     ->first()
        //     ->purposes()
        //     ->saveMany([
        //         new LeaveTypePurpose(['name' => 'optional_leave']),
        //     ]);
    }
}
