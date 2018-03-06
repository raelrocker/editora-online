<?php
namespace CodePub\Criteria;

trait CriteriaOnlyTrashedTrait {

    public function onlyTrashed() {
        $this->pushCriteria(FindOnlyTrashedCriteria::class);
        return $this;
    }
}