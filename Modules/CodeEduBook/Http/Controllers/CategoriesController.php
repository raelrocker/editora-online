<?php

namespace CodeEduBook\Http\Controllers;

use CodePub\Criteria\FindByNameCriteria;
use CodeEduBook\Models\Category;
use CodeEduBook\Http\Requests\CategoryRequest;
use CodeEduBook\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use CodeEduUser\Http\Requests\PermissionRequest;
use CodeEduUser\Annotations\Mapping as Permission;

/**
 * @Permission\Controller(name="categorias-admin", description="Administração de categorias")
 */
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
     * @Permission\Action(name="list", description="Ver listagem de categorias")
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request->get('search');
        $this->repository
            ->pushCriteria(new FindByNameCriteria($search));
        $categories = $this->repository->paginate(10);
        return view('codeedubook::category.index', compact('categories', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     * @Permission\Action(name="store", description="Criar categorias")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeedubook::category.create');
    }

    /**
     * Store a newly created resource in storage.
     * @Permission\Action(name="store", description="Criar categorias")
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
     * @Permission\Action(name="update", description="Atualizar categorias")
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Category $category
     */
    public function edit($id)
    {
        $category = $this->repository->find($id);
        return view('codeedubook::category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @Permission\Action(name="update", description="Atualizar categorias")
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
     * @Permission\Action(name="destroy", description="Excluir categorias")
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
