<?php

namespace CodeEduUser\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use CodeEduUser\Models\Role;

/**
 * Class UserRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    /*
    public function update(array $attributes, $id) {
        $model = parent::update($attributes, $id);
        if (isset($attributes['permissions'])) {
            $model->permissions()->sync($attributes['permissions']);
        } else {
            $model->permissions()->detach();
        }
        return $model;
    }*/
    
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function updatePermissions(array $permissions, $id)
    {
        $model = parent::find($id);
        $model->permissions()->detach();
        if (count($permissions)) {
            $model->permissions()->sync($permissions);
        }
        return $model;
    }
}
