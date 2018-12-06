<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Requests\RoleDeleteRequest;
use CodeEduUser\Http\Requests\RoleRequest;
use CodeEduUser\Repositories\RoleRepository;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use CodeEduUser\Repositories\PermissionRepository;
use CodeEduUser\Criteria\FindPermissionsResourceCriteria;
use CodeEduUser\Criteria\FindPermissionsGroupResourceCriteria;
use CodeEduUser\Http\Requests\PermissionRequest;

class RolesController extends Controller
{

    /**
     * @var RoleRepository
     */
    private $repository;
    
    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    public function __construct(RoleRepository $repository, PermissionRepository $permissionRepository)
    {
        $this->repository = $repository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $roles = $this->repository->paginate(10);
        return view('codeeduuser::roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeeduuser::roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Papel de usuário cadastrado com sucesso.');
        return redirect()->to($url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param User $user
     */
    public function edit($id)
    {
        $role = $this->repository->find($id);
        return view('codeeduuser::roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest|UserRequest|Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param User $user
     */
    public function update(RoleRequest $request, $id)
    {
        $data = $request->except('permissions');
        $this->repository->update($data, $id);
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Papel de usuário alterado com sucesso.');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RoleDeleteRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param User $user
     * @internal param int $id
     */
    public function destroy(RoleDeleteRequest $request, $id)
    {
        try {
            $this->repository->delete($id);
            \Session::flash('message', 'Papel de usuário excluído com sucesso.');

        } catch(QueryException $ex) {
            \Session::flash('error', 'Papel de usuário não pode ser excluído. Ele está relacionado com outros registros.');
        }

        return redirect()->to(\URL::previous());
    }
    
    public function editPermission($id)
    {
        $role = $this->repository->find($id);
        $this->permissionRepository->pushCriteria(new FindPermissionsResourceCriteria());
        $permissions = $this->permissionRepository->all();
        $this->permissionRepository->resetCriteria();
        $this->permissionRepository->pushCriteria(new FindPermissionsGroupResourceCriteria());
        $permissionsGroup = $this->permissionRepository->all(['name', 'description']);
        return view('codeeduuser::roles.permissions', compact('role', 'permissions', 'permissionsGroup'));
    }
    
    public function updatePermission(PermissionRequest $request, $id)
    {
        $data = $request->only('permissions');
        $this->repository->update($data, $id);
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Permissões atribuídas com sucesso.');
        return redirect()->to($url);
    }
}
