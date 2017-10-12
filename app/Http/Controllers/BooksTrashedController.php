<?php

namespace CodePub\Http\Controllers;


use CodePub\Models\Book;
use CodePub\Repositories\BookRepository;
use Illuminate\Http\Request;

class BooksTrashedController extends Controller
{
    /**
     * @var BookRepository
     */
    private $repository;

    /**
     * BooksController constructor.
     * @param BookRepository $repository
     */
    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $books = Book::onlyTrashed()->paginate(10);
        //$this->repository
        //    ->pushCriteria(new FindByTitleCriteria($search));
        //$books = $this->repository->paginate(10);
        return view('trashed.book.index', compact('books', 'search'));
    }
}
