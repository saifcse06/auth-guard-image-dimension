<?php

use Illuminate\Database\Seeder;

class SystemAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Admin::insert([
            'name' => 'System Admin',
            'email' => 'system_admin@gmail.com',
            'admin_type' => \App\Admin::TYPE_SYSTEM,
            'password' => bcrypt('123321'),
        ]);
    }
}
