<?php

use App\CrmStatus;
use Illuminate\Database\Seeder;

class CrmStatusTableSeeder extends Seeder
{
    public function run()
    {
        $crmStatuses = [
            [
                'id'         => '1',
                'name'       => 'Lead',
                'created_at' => '2019-12-16 19:01:13',
                'updated_at' => '2019-12-16 19:01:13',
            ],
            [
                'id'         => '2',
                'name'       => 'Customer',
                'created_at' => '2019-12-16 19:01:13',
                'updated_at' => '2019-12-16 19:01:13',
            ],
            [
                'id'         => '3',
                'name'       => 'Partner',
                'created_at' => '2019-12-16 19:01:13',
                'updated_at' => '2019-12-16 19:01:13',
            ],
        ];

        CrmStatus::insert($crmStatuses);
    }
}
