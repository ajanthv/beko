<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Administrator',
                'slug' => 'administrator',
                'permissions' => json_encode([
                    "user.create" => true,
                    "user.delete" => true,
                    "user.view"   => true,
                    "user.update" => true
                ])
            ],
            [
                'name' => 'Moderator',
                'slug' => 'moderator',
                'permissions' => json_encode([
                    "user.create" => false,
                    "user.delete" => false,
                    "user.view"   => true,
                    "user.update" => true
                ])
            ]
        ];

        EloquentRole::insert($data);
    }
}
