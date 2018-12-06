<?php

namespace CodeEduUser\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use CodeEduUser\Annotations\PermissionReader;

class AuthorizationResource
{

    /**
     * @var PermissionReader
     */
    private $reader;

    public function __construct(PermissionReader $reader) {
        
        $this->reader = $reader;
    }
    
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
        $permission = $this->reader->getPermission($controller, $action);
        if (count($permission)) {
            
        }
        return $next($request);
    }
}
