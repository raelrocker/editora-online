<?php

namespace CodePub\Repositories;

use CodeEduBook\Repositories\BookRepositoryEloquent;
use CodeEduStore\Repositories\ProductRepository;


/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class ProductStoreRepositoryEloquent extends BookRepositoryEloquent implements ProductRepository
{

    public function home()
    {
        return $this->model->where('published', 1)->paginate(12)->items();
    }
}
