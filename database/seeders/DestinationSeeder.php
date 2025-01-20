<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Destination::create([
            'name' => 'Jakarta',
            'description' => 'The capital city of Indonesia, known for its bustling urban life and business district.',
            'location' => 'West Java, Indonesia'
        ]);
    }
}


