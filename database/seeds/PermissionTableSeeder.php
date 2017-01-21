<?php

use App\Models\PermissionsModel;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
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
                'permission_name' => 'Create user',
                'permission_slug' => 'user.create'
            ],
            [
                'permission_name' => 'Delete user',
                'permission_slug' => 'user.delete'
            ],
            [
                'permission_name' => 'View user',
                'permission_slug' => 'user.view'
            ],
            [
                'permission_name' => 'Edit user',
                'permission_slug' => 'user.update'
            ]
        ];

        PermissionsModel::insert($data);
    }
}
