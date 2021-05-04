<?php

use Illuminate\Database\Seeder;
use App\PaymentMethod;

class MetodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::create([
            'name' => 'Efectivo'
        ]);

        PaymentMethod::create([
            'name' => 'Tarjeta de debito/credito'
        ]);

        PaymentMethod::create([
            'name' => 'Transferencia Interbancaria'
        ]);

    }
}
