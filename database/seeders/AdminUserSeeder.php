<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'lerichard',
            'email' => 'ricardo.valladares.triminio@gmail.com',
            'password' => Hash::make('R1c4rd094'),
        ]);
    }
}
