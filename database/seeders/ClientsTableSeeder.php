<?php

namespace Database\Seeders;

use App\Models\client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = ['ahmed', 'mohamed'];

        foreach ($clients as $client) {

            Client::create([
               'name' => $client,
               'phone' => '0111113242',
               'address' => 'cairo',
            ]);

        }//end of foreach

    }//end of run

}//end of seeder
