<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Requests\UserDeleteRequest;
use CodePub\Criteria\FindByNameCriteria;
use CodeEduUser\Models\User;
use CodeEduUser\Http\Requests\UserRequest;
use CodeEduUser\Repositories\UserRepository;
use Illuminate\Http\Request;
use CodeEduUser\Annotations\Mapping as Permission;
use CodeEduUser\Repositories\RoleRepository;

/**
 * @Permission\Controller(name="user-admin", description="Administração de usuário")
 */
class UsersController extends Controller
{

    /**
     * @var UserRepository
     */
    private $repository;
    
     /**
     * @var RoleRepository
     */
    private $roleRepository;

    public function __construct(UserRepository $repository, RoleRepository $roleReporitory)
    {
        $this->repository = $repository;
        $this->roleRepository = $roleReporitory;
    }

    /**
     * Display a listing of the resource.
     * @Permission\Action(name="list", description="Ver listagem de usuários")
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //$search = $request->get('search');
        //$this->repository
        //    ->pushCriteria(new FindByNameCriteria($search));
        $users = $this->repository->paginate(10);
        return view('codeeduuser::users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     * @Permission\Action(name="store", description="Criar usuários")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleRepository->all()->pluck('name', 'id');
        return view('codeeduuser::users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @Permission\Action(name="store", description="Criar usuários")
     * @param UserRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('codeeduuser.users.index'));
        $request->session()->flash('message', 'Usuário cadastrado com sucesso.');
        return redirect()->to($url);
    }

    /**
     * Show the form for editing the specified resource.
     * @Permission\Action(name="update", description="Atualizar usuários")
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param User $user
     */
    public function edit($id)
    {
        $user = $this->repository->find($id);
        $roles = $this->roleRepository->all()->pluck('name', 'id');
        return view('codeeduuser::users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     * @Permission\Action(name="update", description="Atualizar usuários")
     * @param UserRequest|Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param User $user
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->except(['password']);
        $this->repository->update($data, $id);
        $url = $request->get('redirect_to', route('codeeduuser.users.index'));
        $request->session()->flash('message', 'Usuário alterado com sucesso.');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     * @Permission\Action(name="destroy", description="Excluir usuários")
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param User $user
     * @internal param int $id
     */
    public function destroy(UserDeleteRequest $request, $id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Usuário excluído com sucesso.');
        return redirect()->to(\URL::previous());
    }
}
