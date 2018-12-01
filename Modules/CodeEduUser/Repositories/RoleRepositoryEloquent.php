<?php

namespace CodeEduUser\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use CodeEduUser\Models\Role;

/**
 * Class UserRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }
}
