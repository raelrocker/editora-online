<?php

namespace CodePub\Repositories;

use CodeEduBook\Repositories\BookRepositoryEloquent;
use CodeEduStore\Repositories\CategoryRepository;
use CodeEduStore\Repositories\ProductRepository;


/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class ProductStoreRepositoryEloquent extends BookRepositoryEloquent implements ProductRepository
{

    private $categoryRepository;

    public function home()
    {
        //return $this->model->where('published', 1)->paginate(12)->items();
        return $this->model->search("")->take(12)->get();
    }

    public function findByCategory($id)
    {
        $category = $this->categoryRepository->find($id);
        return $category->books()->where('published', 1)->get();
    }

    public function boot()
    {
        $this->categoryRepository = app(CategoryRepository::class);
        parent::boot();
    }

    public function like($search)
    {
        return $this->model->search($search)->paginate(20);
    }

    public function findBySlug($slug)
    {
        return $this->model->findBySlugOrFail($slug);
    }

    public function makeProductStore($id)
    {
        $book = $this->find($id);
        $productStore = new ProductStore();
        $productStore->setId($book->id)
            ->setName($book->title)
            ->setPrice($book->price)
            ->setProductOriginal($book);
        return $productStore;
    }
}
