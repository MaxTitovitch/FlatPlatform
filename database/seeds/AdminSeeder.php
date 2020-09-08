<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => env('ADMIN_NAME'),
            'last_name' => env('ADMIN_LAST_NAME'),
            'phone' => env('ADMIN_PHONE'),
            'role_id' => 1,
            'email' => env('ADMIN_EMAIL'),
            'password' => env('ADMIN_PASSWORD'),
            'email_verified_at' => date('Y-m-d h:i:s'),
        ]);
    }
}
