<?php

namespace CodePub\Repositories;

trait RepositoryRestoreTrait {
    
    public function restore($id) {
        $this->applyScope();
        
        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);
        
        $model = $this->find($id);
        
        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();
        
        $model->restore();
    }
}