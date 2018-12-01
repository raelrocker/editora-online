<?php

namespace CodeEduUser\Http\Controllers;

use CodePub\Criteria\FindByNameCriteria;
use CodeEduUser\Models\User;
use CodeEduUser\Http\Requests\UserSettingRequest;
use CodeEduUser\Repositories\UserRepository;
use Illuminate\Http\Request;
use Jrean\UserVerification\Traits\VerifiesUsers;
use CodeEduUser\Annotations\Mapping\Controller as ControllerAnnotation;
use CodeEduUser\Annotations\Mapping\Action as ActionAnnotation;

/**
 * @Controller(name="user-settings", description="Administração de usuário")
 */
class UserSettingsController extends Controller
{

    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * Show the form for editing the specified resource.
     * 
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param User $user
     */
    public function edit()
    {
        $user = \Auth::user();
        return view('codeeduuser::user-settings.setting', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest|Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param User $user
     */
    public function update(UserSettingRequest $request)
    {
        $user = \Auth::user();
        $this->repository->update($request->all(), $user->id);
        $request->session()->flash('message', 'Usuário alterado com sucesso.');
        return redirect()->route('codeeduuser.user_settings.edit');
    }

}
