<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sample_clinics = [
            [
                'clinic_no' => '54',
                'name' => 'Vision Checking',
            ],
            [
                'clinic_no' => '55',
                'name' => 'Doctor Consultation',
            ],
            [
                'clinic_no' => '56',
                'name' => 'Doctor Consultation',
            ],
            [
                'clinic_no' => '57',
                'name' => 'Doctor Consultation',
            ],
            [
                'clinic_no' => '58',
                'name' => 'Doctor Consultation',
            ],
            [
                'clinic_no' => '59',
                'name' => 'Doctor Consultation',
            ],
            [
                'clinic_no' => 'A',
                'name' => 'Power Checking',
            ],
            [
                'clinic_no' => 'B',
                'name' => 'Power Checking',
            ],
            [
                'clinic_no' => 'C',
                'name' => 'Power Checking',
            ],
            [
                'clinic_no' => 'D',
                'name' => 'Power Checking',
            ],
        ];

        foreach ($sample_clinics as $clinic) {
            DB::table('clinics')->insert([
                'clinic_no' => $clinic['clinic_no'],
                'name' => $clinic['name']
            ]);
        }
    }
}
