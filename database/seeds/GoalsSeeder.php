<?php

use Illuminate\Database\Seeder;

class GoalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goals')->insert([
            'name' => 'English B1',
            'confirmation_method' => 'Задание в файле',
            'description' => 'Нужно уметь свободно изъясняться на знакомые темы, уметь поддерживать разговор на новые темы. Знать основные грамматические правила языка.',
        ]);
        DB::table('goals')->insert([
            'name' => 'Основы тестирования ПО',
            'confirmation_method' => 'Задание в файле',
            'description' => 'Нужно уметь составлять тестовые кейсы и с их помощью тестировать ПО. Знать основные принципы тестирования.',
        ]);
        DB::table('goals')->insert([
            'name' => 'Шаблоны проектирования',
            'confirmation_method' => 'Задание в файле',
            'description' => 'Нужно знать и уметь применять шаблоны проектирования. Иметь опыт работы с ними на 5 проектах.',
        ]);

        DB::table('goal_qualification')->insert([
            'qualification_id' => 1,
            'goal_id' => 3
        ]);
        DB::table('goal_qualification')->insert([
            'qualification_id' => 2,
            'goal_id' => 1
        ]);
        DB::table('goal_qualification')->insert([
            'qualification_id' => 2,
            'goal_id' => 2
        ]);
    }
}
