<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            
            [
                'nom' => 'andreu', 
                'cognoms' => 'paredes', 
                'email' => 'info@osonaweb.cat', 
                'email_verified_at' => Carbon::now(), 
                'password' => md5('admin'), 
                'token' => md5('info@osonaweb.cat'), 
                'remember_token' => md5('info@osonaweb.cat'.Carbon::now()), 
                'created_at' => Carbon::now() 
            ]

        ]);
    }
}
