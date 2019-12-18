<?php

use Illuminate\Database\Seeder;

class UserGoalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goals_users')->insert([
            'user_id' => 2,
            'goal_id' => 2,
            'status' => 'Выполнена',
        ]);
        DB::table('goals_users')->insert([
            'user_id' => 2,
            'goal_id' => 1,
            'status' => 'Назначена',
        ]);
        DB::table('goals_users')->insert([
            'user_id' => 3,
            'goal_id' => 2,
            'status' => 'Ожидает проверки',
        ]);
    }
}
