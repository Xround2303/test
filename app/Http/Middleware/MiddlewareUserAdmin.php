<?php

namespace App\Http\Middleware;

use Closure;
use App\Interface\InterfaceRepositoryUser;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MiddlewareUserAdmin
{
    public function __construct(protected InterfaceRepositoryUser $repositoryUser) {

    }

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws Exception
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($this->repositoryUser->isCurrentUserAdmin()) {
            return $next($request);
        }

        throw new Exception("Недостаточно прав", 403);
    }
}
