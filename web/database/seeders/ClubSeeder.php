<?php

namespace Database\Seeders;

use App\Models\Club;
use Illuminate\Database\Seeder;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Club::insert([
            'name'          => 'Tenis Meja',
            'abbreviation'  => 'TM',
            'owner'         => null,
            'hp'            => null,
            'address'       => null
        ]);
    }
}
