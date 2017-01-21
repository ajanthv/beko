<?php
/**
 * Created by PhpStorm.
 * User: lasith_g
 * Date: 9/15/2015
 * Time: 12:51 PM
 */

namespace App\Repositories\Contracts;

/**
 *
 * Base pattern for all repositories
 *
 * Interface RepositoryInterface
 * @package App\Repositories\Contracts
 */
interface RepositoryInterface
{
    /**
     * Get all records
     *
     * @param array $columns
     * @return mixed
     */
    public function all($columns = ['*']);

    /**
     * Get paginated results
     *
     * @param null $limit
     * @param array $columns
     * @return mixed
     */
    public function paginate($limit = null, $columns = ['*']);

    /**
     * Find a record
     * @param int $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*']);

    /**
     * Find record by field name
     *
     * @param String $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findByField($field, $value, $columns = ['*']);

    /**
     * Find records by condition
     *
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findWhere(array $where, $columns = ['*']);

    /**
     * Find records where in
     *
     * @param String $field
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findWhereIn($field, array $where, $columns = ['*']);

    /**
     * Find records where not in
     *
     * @param String $field
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findWhereNotIn($field, array $where, $columns = ['*']);

    /**
     * Create
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update
     *
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, $id);

    /**
     * Delete
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Assign user role
     *
     * @param $userId
     * @param $roleSlug
     * @return bool
     */
    public function assignRole($userId, $roleSlug);

    /**
     * Assign user permissions
     *
     * @param $userId
     * @param array $permissions
     * @return bool
     */
    public function assignPermissions($userId, $permissions);


}
