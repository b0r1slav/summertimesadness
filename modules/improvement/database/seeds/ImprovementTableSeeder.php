<?php

use Illuminate\Database\Seeder;

class ImprovementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            EvaluationsTableSeeder::class,
            PointsApprovementsTableSeeder::class,
            TasksTableSeeder::class
        ]);
    }
}