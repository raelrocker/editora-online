<?php
namespace CodePub\Criteria;

interface CriteriaTrashedInterface {
    public function onlyTrashed();

    public function withTrashed();
}