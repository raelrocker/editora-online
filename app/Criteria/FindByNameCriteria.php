<?php

namespace CodePub\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByNameCriteria
 * @package namespace CodePub\Criteria;
 */
class FindByNameCriteria implements CriteriaInterface
{

    /**
     * @var
     */
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('name', 'LIKE', "%{$this->name}%");
    }
}
