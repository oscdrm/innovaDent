<?php

use Illuminate\Database\Seeder;
use App\Surgery;

class SurgerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Surgery::create([
            'name' => 'Huetamo',
            'address' => 'conocido'
        ]);

        Surgery::create([
            'name' => 'Maravatio',
            'address' => 'conocido'
        ]);
    }
}
