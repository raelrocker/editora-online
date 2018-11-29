<?php

namespace CodeEduBook\Http\Requests;

use CodeEduBook\Http\Requests\BookCreateRequest;
use CodeEduBook\Repositories\BookRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookUpdateRequest extends BookCreateRequest
{

    /**
     * @var BookRepository
     */
    private $repository;

    public function __construct(BookRepository $repository)
    {

        $this->repository = $repository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = (int)$this->route('book');
        if ($id == 0) {
            return false;
        }

        $book = $this->repository->find($id);

        return \Gate::allows('update-book', $book);
    }
}
