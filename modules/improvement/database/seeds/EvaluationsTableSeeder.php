<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class EvaluationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $evaluations = [
            [
                'user_id' => 2,
                'title' => 'solving math tasks',
                'must' => 90,
                'current' => 0,
                'is_active' => 1
            ],
            [
                'user_id' => 2,
                'title' => 'workouts',
                'must' => 90,
                'current' => 0,
                'is_active' => 1
            ]
        ];

        DB::table('evaluations')->insert($evaluations);
    }
}