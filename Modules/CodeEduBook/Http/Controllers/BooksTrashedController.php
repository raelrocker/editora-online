<?php

namespace CodeEduBook\Http\Controllers;


use CodeEduBook\Models\Book;
use CodeEduBook\Repositories\BookRepository;
use Illuminate\Http\Request;
use CodePub\Criteria\FindOnlyTrashedCriteria;
use CodeEduUser\Http\Requests\PermissionRequest;
use CodeEduUser\Annotations\Mapping as Permission;

/**
 * @Permission\Controller(name="books-trashed-admin", description="Administração da lixeira de  livros")
 */
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
     * @Permission\Action(name="list", description="Ver listagem de livros na lixeira")
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $books = $this->repository->onlyTrashed()->paginate(10);
        return view('codeedubook::trashed.book.index', compact('books', 'search'));
    }
    
    /**
     * Show the form for editing the specified resource.
     * @Permission\Action(name="show", description="Ver livro na lixeira")
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->repository->onlyTrashed();
        $book = $this->repository->find($id);
        return view('trashed.book.show', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     * @Permission\Action(name="update", description="Atualizar livro na lixeira")
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->repository->onlyTrashed();
        $this->repository->restore($id);

        $url = $request->get('redirect_to', route('trashed.books.index'));
        $request->session()->flash('message', 'Livro restaurado com sucesso.');
        return redirect()->to($url);
    }
}
