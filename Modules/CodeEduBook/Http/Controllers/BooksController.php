<?php

namespace CodeEduBook\Http\Controllers;

use CodeEduBook\Criteria\FindByAuthor;
use CodePub\Criteria\FindByAuthorCriteria;
use CodePub\Criteria\FindByTitleCriteria;
use CodeEduBook\Http\Requests\BookCreateRequest;
use CodePub\Http\Requests\BookRequest;
use CodeEduBook\Http\Requests\BookUpdateRequest;
use CodeEduBook\Models\Category;
use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Repositories\CategoryRepository;
use Illuminate\Http\Request;

use CodeEduUser\Http\Requests\PermissionRequest;
use CodeEduUser\Annotations\Mapping as Permission;

/**
 * @Permission\Controller(name="books-admin", description="Administração de livros")
 */
class BooksController extends Controller
{
    /**
     * @var BookRepository
     */
    private $repository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * BooksController constructor.
     * @param BookRepository $repository
     */
    public function __construct(BookRepository $repository, CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->repository->pushCriteria(new FindByAuthor());
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     * @Permission\Action(name="list", description="Ver listagem de livros")
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $books = $this->repository->paginate(10);
        return view('codeedubook::book.index', compact('books', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     * @Permission\Action(name="store", description="Criar livros")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->lists('name', 'id');
        return view('codeedubook::book.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @Permission\Action(name="store", description="Criar livros")
     * @param BookCreateRequest|BookRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookCreateRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = \Auth::user()->id;
        $this->repository->create($data);
        $url = $request->get('redirect_to', route('books.index'));
        $request->session()->flash('message', 'Livro cadastrado com sucesso.');
        return redirect()->to($url);
    }


    /**
     * Show the form for editing the specified resource.
     * @Permission\Action(name="update", description="Atualizar livros")
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Book $book
     * @internal param Book $books
     * @internal param int $id
     */
    public function edit($id)
    {
        $book = $this->repository->find($id);
        //$categories = $this->categoryRepository->lists('name', 'id');
        $this->categoryRepository->withTrashed();
        $categories = $this->categoryRepository->listsWithMutators('name_trashed', 'id');
        return view('codeedubook::book.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @Permission\Action(name="update", description="Atualizar livros")
     * @param BookRequest|BookUpdateRequest|Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Book $book
     * @internal param int $id
     */
    public function update(BookUpdateRequest $request, $id)
    {
        $data = $request->except(['user_id']);
        $this->repository->update($data, $id);
        $url = $request->get('redirect_to', route('books.index'));
        $request->session()->flash('message', 'Livro alterado com sucesso.');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     * @Permission\Action(name="destroy", description="Excluir livros")
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Book $book
     * @internal param int $id
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Livro excluída com sucesso.');
        return redirect()->route('books.index');
    }
}
