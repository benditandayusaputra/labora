<?php

namespace Database\Seeders;

use App\Models\Tournament;
use Illuminate\Database\Seeder;

class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tournament::insert([
            'name'          => 'Tenis Meja',
            'description'   => 'Testing Tour',
            'price'         => 20000,
            'quota'         => 50,
            'is_open'       => true,
            'start_regist'  => null,
            'finish_regist' => null,
            'logo'          => null
        ]);
    }
}