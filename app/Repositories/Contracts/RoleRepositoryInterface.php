<?php
/**
 * Created by PhpStorm.
 * User: lasith_g
 * Date: 9/15/2015
 * Time: 12:51 PM
 */

namespace App\Repositories\Contracts;

/**
 * Interface RoleRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface RoleRepositoryInterface
{

    /**
     * @param $roleId
     * @return mixed
     */
    public function find($roleId);

    /**
     * @param $roleSlug
     * @return mixed
     */
    public function findBySlug($roleSlug);

    /**
     * @param $roleName
     * @return mixed
     */
    public function findByName($roleName);

    /**
     * @param array $role
     * @return mixed
     */
    public function create($role);

    /**
     * Assign role permissions
     *
     * @param $roleSlog
     * @param array $permissions
     * @return bool
     */
    public function assignPermissions($roleSlog, $permissions);

}
