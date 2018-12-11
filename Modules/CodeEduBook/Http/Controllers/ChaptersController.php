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
use CodeEduBook\Http\Requests\ChapterUpdateRequest;

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
    public function edit(Book $book, $chapterId)
    {
        $this->bookRepository->pushCriteria(new FindByBook($book->id));
        $chapter = $this->repository->find($chapterId);
        return view('codeedubook::chapters.edit', compact('book', 'chapter'));
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
    public function update(ChapterUpdateRequest $request, Book $book, $chapterId)
    {
        $this->bookRepository->pushCriteria(new FindByBook($book->id));
        $data = $request->except(['book_id']);
        $this->repository->update($data, $chapterId);
        $url = $request->get('redirect_to', route('chapters.index', ['book' => $book->id]));
        $request->session()->flash('message', 'Capítulo alterado com sucesso.');
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
    public function destroy(Book $book, $chapterId)
    {
        $this->bookRepository->pushCriteria(new FindByBook($book->id));
        $this->repository->delete($chapterId);
        \Session::flash('message', 'Capítulo excluída com sucesso.');
        return redirect()->to(\URL::previous());
    }
}
