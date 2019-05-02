<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Admin::create([
            'name' => 'Manson Xasthur',
            'email' => 'mansonx13@gmail.com',
            'role_id' => 1,
            'password' => bcrypt('lestat'),
        ]);
    }
}
