<?php

use Illuminate\Database\Seeder;
use App\Service;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = ['wifi','car','pool','concierge','sauna'];

        for ($i=0; $i < count($services) ; $i++) { 
            $new_service = new Service();
            $new_service->name = $services[$i];
            $new_service->save();
        }
    }
}
