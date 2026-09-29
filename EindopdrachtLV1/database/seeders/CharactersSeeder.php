<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharactersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('characters')->insert([
            [
                'name' => 'Pikachu',
                'game' => 'Pokemon',
                'released' => '2019-05-08'
            ],
            [
                'name' => 'Doomfist',
                'game' => 'Overwatch 2',
                'released' => '2017-07-27'
            ],
            [
                'name' => 'Dante',
                'game' => 'Devil May Cry',
                'released' => '2001-08-23'
            ],
            [
                'name' => 'Iq',
                'game' => 'Rainbow Six Siege',
                'released' => '2015-12-01'
            ],
            [
                'name' => 'Franklin Clinton',
                'game' => 'Grand Theft Auto V',
                'released' => '2015-09-17'
            ]
        ]);
    }
}
