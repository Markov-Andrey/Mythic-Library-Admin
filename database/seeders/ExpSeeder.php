<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modifierData = [
            [1, 0, 2],
            [2, 300, 2],
            [3, 900, 2],
            [4, 2700, 2],
            [5, 6500, 3],
            [6, 14000, 3],
            [7, 23000, 3],
            [8, 34000, 3],
            [9, 48000, 4],
            [10, 64000, 4],
            [11, 85000, 4],
            [12, 100000, 4],
            [13, 120000, 5],
            [14, 140000, 5],
            [15, 165000, 5],
            [16, 195000, 5],
            [17, 225000, 6],
            [18, 265000, 6],
            [19, 305000, 6],
            [20, 355000, 6],
        ];

        foreach ($modifierData as $data) {
            $level = $data[0];
            $points = $data[1];
            $mastery_bonus = $data[2];

            Experience::create([
                'level' => $level,
                'points' => $points,
                'mastery_bonus' => $mastery_bonus,
            ]);
        }
    }
}
