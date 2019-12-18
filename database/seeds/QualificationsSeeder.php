<?php

use Illuminate\Database\Seeder;

class QualificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('qualifications')->insert([
            'name' => 'Senior developer - 1',
            'sign' => 'Senior-1',
            'description' => ''
        ]);
        DB::table('qualifications')->insert([
            'name' => 'Middle developer - 3',
            'sign' => 'Middle-3',
            'description' => '',
            'next_qualification' => 1,
        ]);
        DB::table('qualifications')->insert([
            'name' => 'Middle developer - 2',
            'sign' => 'Middle-2',
            'description' => '',
            'next_qualification' => 2,
        ]);

        DB::table('qualifications')->insert([
            'name' => 'Department manager',
            'sign' => 'Manager-2',
            'description' => ''
        ]);
        DB::table('qualifications')->insert([
            'name' => 'Group manager',
            'sign' => 'Manager-1',
            'description' => '',
            'next_qualification' => 4,
        ]);
    }
}
