<?php
/**
 * Created by PhpStorm.
 * User: lasith_g
 * Date: 9/15/2015
 * Time: 12:49 PM
 */

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class UserRepository implements UserRepositoryInterface
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get all records
     *
     * @param array $columns
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        return $this->user->all($columns);
    }

    /**
     * Get paginated results
     *
     * @param null $limit
     * @param array $columns
     * @return mixed
     */
    public function paginate($limit = null, $columns = ['*'])
    {
        return $this->user->paginate($limit, $columns);
    }

    /**
     * Find a record
     * @param int $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->user->find($id, $columns);
    }

    /**
     * Find record by field name
     *
     * @param String $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findByField($field, $value, $columns = ['*'])
    {
        return $this->user->where($field, $value)->get($columns);
    }

    /**
     * Find records by condition
     *
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findWhere(array $where, $columns = ['*'])
    {
        return $this->user->where($where)->get($columns);
    }

    /**
     * Find records where in
     *
     * @param String $field
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findWhereIn($field, array $where, $columns = ['*'])
    {
        return $this->user->whereIn($field, $where)->get($columns);
    }

    /**
     * Find records where not in
     *
     * @param String $field
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findWhereNotIn($field, array $where, $columns = ['*'])
    {
        return $this->user->whereNotIn($field, $where)->get($columns);
    }

    /**
     * Create
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->user->create($attributes);
    }

    /**
     * Update
     *
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        $user =  $this->user->find($id);

        foreach ($attributes as $k => $v) {
            $user->$k = $v;
        }

        $user->save();

        return $user;
    }

    /**
     * Delete
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->user->find($id)->delete();
    }

    /**
     * Assign user role
     *
     * @param $userId
     * @param $roleSlug
     * @return bool
     */
    public function assignRole($userId, $roleSlug)
    {
        $role = Sentinel::findRoleBySlug($roleSlug);

        $user = $this->user->find($userId);

        $user->roles()->attach($role);

        return true;
    }

    /**
     * Assign user permissions
     *
     * @param $userId
     * @param array $permissions
     * @return bool
     */
    public function assignPermissions($userId, $permissions)
    {
        $user = $this->user->find($userId);

        $user->permissions = $permissions;

        $user->save();

        return true;
    }

}
