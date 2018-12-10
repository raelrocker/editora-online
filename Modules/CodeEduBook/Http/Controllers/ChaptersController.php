<?php

namespace CodeEduBook\Http\Controllers;

use CodeEduBook\Criteria\FindByAuthor;
use CodeEduBook\Http\Requests\BookCreateRequest;
use CodePub\Http\Requests\BookRequest;
use CodeEduBook\Http\Requests\BookUpdateRequest;
use CodeEduBook\Repositories\BookRepository;
use Illuminate\Http\Request;
use CodeEduBook\Repositories\ChapterRepository;
use CodeEduBook\Criteria\FindByBook;
use CodeEduBook\Http\Requests\ChapterCreateRequest;
use CodeEduBook\Models\Book;

use CodeEduUser\Http\Requests\PermissionRequest;
use CodeEduUser\Annotations\Mapping as Permission;

/**
 * @Permission\Controller(name="books-admin", description="Administração de livros")
 */
class ChaptersController extends Controller
{
    /**
     * @var ChaptersRepository
     */
    private $repository;
    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * Contructor
     * @param ChapterRepository $repository
     * @param BookRepository $bookRepository
     */
    public function __construct(ChapterRepository $repository, BookRepository $bookRepository)
    {
        $this->repository = $repository;
        $this->bookRepository = $bookRepository;
        $this->bookRepository->pushCriteria(new FindByAuthor());
    }

    /**
     * Display a listing of the resource.
     * @Permission\Action(name="chapter", description="Capítulos")
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Book $book)
    {
        $search = $request->get('search');
        $this->repository->pushCriteria(new FindByBook($book->id));
        $chapters = $this->repository->paginate(10);
        
        return view('codeedubook::chapters.index', compact('chapters', 'search', 'book'));
    }

    /**
     * Show the form for creating a new resource.
     * @Permission\Action(name="store", description="Capítulos")
     * @return \Illuminate\Http\Response
     */
    public function create(Book $book)
    {
        return view('codeedubook::chapters.create', compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     * @Permission\Action(name="store", description="Capítulos")
     * @param BookCreateRequest|BookRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChapterCreateRequest $request, Book $book)
    {
        $data = $request->all();
        $data['book_id'] = $book->id;
        $this->repository->create($data);
        $url = $request->get('redirect_to', route('chapters.index', ['book', $book->id]));
        $request->session()->flash('message', 'Capítulo cadastrado com sucesso.');
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
