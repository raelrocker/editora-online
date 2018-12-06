<?php

namespace CodeEduUser\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;


class AuthorizationResource
{

    /**
     * @var PermissionReader
     
    private $reader;
    
    /*
    public function __construct(PermissionReader $reader) {
        
        $this->reader = $reader;
    }*/
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $currentAction = \Route::currentRouteAction();
        list($controller, $action) = explode('@', $currentAction);
        $permission = \PermissionReader::getPermission($controller, $action);
        if (count($permission)) {
            $permission = $permission[0];
            if (\Gate::denies("{$permission['name']}/{$permission['resource_name']}")) {
                throw new AuthorizationException('Usuário não autorizado');
            }
        }
        return $next($request);
    }
}
