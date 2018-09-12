<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PointsApprovementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pointsApprovements = [
            [
                'user_id' => 2,
                'evaluation_id' => 1,
                'points' => 2,
                'is_active' => 1,
                'status' => 'pending',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 2,
                'evaluation_id' => 1,
                'points' => 1,
                'is_active' => 1,
                'status' => 'approved',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => 2,
                'evaluation_id' => 1,
                'points' => 3,
                'is_active' => 1,
                'status' => 'refused',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];

        DB::table('points_approvements')->insert($pointsApprovements);
    }
}