<?php

namespace CodeEduUser\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use CodeEduUser\Repositories\PermissionRepository;
use CodeEduUser\Criteria\FindPermissionsResourceCriteria;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'CodePub\Model' => 'CodePub\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Gate::define('update-book', function($user, $book) {
           return $user->id == $book->user_id;
        });

        \Gate::before(function($user, $ability) {
            if ($user->isAdmin()) {
                return true;
            }
        });
        
        /** @var PermissionRepository $permissionRepository */
        $permissionRepository = app(PermissionRepository::class);
        $permissionRepository->pushCriteria(new FindPermissionsResourceCriteria());
        $permissions = $permissionRepository->all();
        foreach ($permissions as $p) {
            \Gate::define("{$p->name}/{$p->resource_name}", function($user) use($p) {
                return $user->hasRole($p->roles);
            });
        }
    }
}
