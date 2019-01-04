<?php

namespace CodeEduStore\Repositories;

use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ProductRepository
 * @package namespace CodePub\Repositories;
 */
interface ProductRepository extends RepositoryInterface, RepositoryCriteriaInterface
{
    public function home();

    public function findByCategory($id);

    public function like($search);
}
