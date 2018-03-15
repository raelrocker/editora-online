<?php

namespace CodePub\Repositories;

use CodePub\Criteria\CriteriaOnlyTrashedInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use CodePub\Repositories\RepositoryRestoreInterface;

/**
 * Interface BookRepository
 * @package namespace CodePub\Repositories;
 */
interface BookRepository extends 
    RepositoryInterface, 
    RepositoryCriteriaInterface, 
    CriteriaOnlyTrashedInterface,
    RepositoryRestoreInterface
{
    //
}
