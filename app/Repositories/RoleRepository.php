<?php
/**
 * Created by PhpStorm.
 * User: lasith_g
 * Date: 5/31/2016
 * Time: 12:49 PM
 */

namespace App\Repositories;

use App\Repositories\Contracts\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{

    public function __construct()
    {
        //
    }

    /**
     * @param $roleId
     * @return mixed
     */
    public function find($roleId)
    {
//        return Sentinel::findRoleById($roleId);
    }

    /**
     * @param $roleSlug
     * @return mixed
     */
    public function findBySlug($roleSlug)
    {
//        return Sentinel::findRoleBySlug($roleSlug);
    }

    /**
     * @param $roleName
     * @return mixed
     */
    public function findByName($roleName)
    {
//        return Sentinel::findRoleByName($roleName);
    }

    /**
     * @param array $role
     * @return mixed
     */
    public function create($role)
    {
//        return Sentinel::getRoleRepository()->createModel()->create($role);
    }

    /**
     * Assign role permissions
     *
     * @param $roleSlog
     * @param array $permissions
     * @return bool
     */
    public function assignPermissions($roleSlog, $permissions)
    {
        $role = $this->findBySlug($roleSlog);

        $role->permissions($permissions);
        $role->save();

        return true;
    }
}
