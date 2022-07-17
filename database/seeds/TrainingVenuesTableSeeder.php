<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\TrainingVenue;

class TrainingVenuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('training_venues')->truncate();

        $this->mockTrainingVenues()->each(function ($venue) {
           TrainingVenue::create($venue);
        });
    }

 
    private function mockTrainingVenues()
    {
        return collect([
            [
                'title' => 'Lalmai Auditorium (AC) No.1',
                'title_bn' => "লালমাই অডিটরিয়াম (এসি) নং-১",
                'capacity' => 100,
                'short_code' => 'DV1'
            ],
            [
                'title' => 'Lalmai Auditorium (AC) No-2',
                'title_bn' => "লালমাই অডিটরিয়াম (এসি) নং-২",
                'capacity' => 100,
                'short_code' => 'DV2'
            ],
            [
                'title' => 'Conference Room-1 (AC)',
                'title_bn' => "সম্মেলন কক্ষ-১ (এসি)",
                'capacity' => 100,
                'short_code' => 'DV3'
            ],
            [
                'title' => 'Dr. Abdul Mood Conference Room-2 (AC)',
                'title_bn' => "ড. আবদুল মুঈদ সম্মেলন কক্ষ-২ (এসি)",
                'capacity' => 100,
                'short_code' => 'DV4'
            ],
            [
                'title' => 'Dr. Abdul Mood Conference Room-2 (AC)',
                'title_bn' => "আব্দুল মান্নান মজুমদার সম্মেলন কক্ষ-৩ (এসি)",
                'capacity' => 100,
                'short_code' => 'DV5'
            ],
            [
                'title' => 'Modern Conference Room-1 (AC)',
                'title_bn' => "মডার্ন সম্মেলন কক্ষ-৪ (এসি)",
                'capacity' => 100,
                'short_code' => 'DV6'
            ],
            [
                'title' => 'IT Lab (AC)',
                'title_bn' => "আইটি ল্যাব (এসি)",
                'capacity' => 100,
                'short_code' => 'DV7'
            ],
            [
                'title' => 'Seminar / Meeting Room (bottom of Hostel 1)',
                'title_bn' => "সেমিনার / মিটিং রুম (হোস্টেল ৭ এর নীচতলা)",
                'capacity' => 100,
                'short_code' => 'DV8'
            ],
            [
                'title' => 'Class Room-1 (AC)',
                'title_bn' => "শ্রেণী কক্ষ-১ (এসি)",
                'capacity' => 100,
                'short_code' => 'DV9'
            ],
            [
                'title' => 'Class Room-2 (AC)',
                'title_bn' => "শ্রেণী কক্ষ-২ (এসি)",
                'capacity' => 100,
                'short_code' => 'DV10'
            ],
            [
                'title' => 'Class Room-3 (AC)',
                'title_bn' => "শ্রেণী কক্ষ-৩ (এসি)",
                'capacity' => 100,
                'short_code' => 'DV11'
            ],
            [
                'title' => 'Class Room-4 (AC)',
                'title_bn' => "শ্রেণী কক্ষ-৪ (এসি)",
                'capacity' => 100,
                'short_code' => 'DV12'
            ],
            [
                'title' => 'Class Room-5 (AC)',
                'title_bn' => "শ্রেণী কক্ষ-৫ (এসি)",
                'capacity' => 100,
                'short_code' => 'DV13'
            ],
        ]);
    }
}
