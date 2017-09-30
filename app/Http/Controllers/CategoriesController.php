<?php

namespace CodePub\Http\Controllers;

use CodePub\Models\Category;
use CodePub\Http\Requests\CategoryRequest;
use CodePub\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    /**
     * @var CategoryRepository
     */
    private $repository;

    public function __construct(CategoryRepository $repository)
    {

        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->repository->paginate(10);
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('categories.index'));
        $request->session()->flash('message', 'Categoria cadastrada com sucesso.');
        return redirect()->to($url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Category $category
     */
    public function edit($id)
    {
        $category = $this->repository->find($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest|Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Category $category
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);
        $url = $request->get('redirect_to', route('categories.index'));
        $request->session()->flash('message', 'Categoria alterada com sucesso.');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Category $category
     * @internal param int $id
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Categoria excluída com sucesso.');
        return redirect()->to(\URL::previous());
    }
}
