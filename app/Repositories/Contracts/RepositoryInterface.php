<?php

/**
 * Created by PhpStorm.
 * User: Araf
 * Date: 10/8/18
 * Time: 4:47 PM
 */

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


/**
 * Interface RepositoryInterface
 * @package App\Repositories\Contracts
 */
interface RepositoryInterface
{
    /**
     * Find a resource by id
     *
     * @param $id
     * @param $relation
     * @return Model|null
     */
    public function findOne($id, $relation);

    /**
     * Find a resource by criteria
     *
     * @param array $criteria
     * @param $relation
     * @return Model|null
     */
    public function findOneBy(array $criteria, $relation);

    /**
     * Search All resources by criteria
     *
     * @param array $searchCriteria
     * @param null $relation
     * @param array|null $orderBy
     * @return Collection
     */
    public function findBy(array $searchCriteria = [], $relation = null, array $orderBy = null);

    /**
     * Search All resources by any values of a key
     *
     * @param string $key
     * @param array $values
     * @param null $relation
     * @param array|null $orderBy
     * @return Collection
     */
    public function findIn($key, array $values, $relation = null, array $orderBy = null);

    /**
     * @param null $perPage
     * @param null $relation
     * @param array|null $orderBy
     * @return Collection
     */
    public function findAll($perPage = null, $relation = null, array $orderBy = null);

    /**
     * @param $id
     * @param null $relation
     * @param array|null $orderBy
     * @return mixed
     */
    public function findOrFail($id, $relation = null, array $orderBy = null);

    /**
     * Save a resource
     *
     * @param array $data
     * @return Model
     */
    public function save(array $data);

    /**
     * Update a resource
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function update(Model $model, array $data);

    /**
     * Delete a resource
     *
     * @param Model $model
     * @return mixed
     */
    public function delete(Model $model);
}
