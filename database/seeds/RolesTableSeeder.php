<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->truncate();
        DB::table('roles')->truncate();

        Sentinel::getRoleRepository()->createModel()->create([
            'slug' => 'admin',
            'name' => 'admin',
            'permissions' => [
                'admin' => true,
                'user' => true, 
            ],
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
          'slug' => 'user',
          'name' => 'user',
          'permissions' => [
              'admin' => true,
              'user' => true, 
          ],
      ]);
    }
}
