<?php

namespace CodePub\Providers;

use Illuminate\Support\Facades\Gate;
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
        \Gate::define('book-download', function ($user, $bookId) {
            $orderRepository = app(OrderRepository::class);
            $order = $orderRepository->findByField('orderable_id', $bookId)->first();
            return !$order ? true : false;
        });
    }
}
