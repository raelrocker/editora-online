<?php


namespace CodeEduBook\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class FindByAuthor implements CriteriaInterface
{

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
        if (!\Auth::user()->isAdmin()) {
            return $model->where('user_id', \Auth::user()->id);
        }
        return $model;
    }
}