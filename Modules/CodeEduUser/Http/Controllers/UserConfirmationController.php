<?php

namespace CodeEduUser\Http\Controllers;

use CodePub\Criteria\FindByNameCriteria;
use CodeEduUser\Models\User;
use CodeEduUser\Http\Requests\UserRequest;
use CodeEduUser\Repositories\UserRepository;
use Illuminate\Http\Request;
use Jrean\UserVerification\Traits\VerifiesUsers;

class UserConfirmationController extends Controller
{

    use VerifiesUsers;
    
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        return route('codeeduuser.user_settings.edit');
    }
    
    public function redirectAfterVerification() 
    {
        parent::redirectAfterVerification();
    }
    
    private function loginUser() 
    {
        $email = \Request::get('email');
        $user = $this->repository->findByField('email', $email)->first();
        \Auth::login($user);
    }
}
