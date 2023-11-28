<?php

namespace App\Http\Middleware;

use App\Models\RolePermission;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $method = '';
        switch ($request->method()) {
            case 'GET':
                $method = 'read';
                break;
            case 'POST':
                $method = 'create';
                break;
            case 'PUT':
                $method = 'update';
                break;
            case 'DELETE':
                $method = 'delete';
                break;
        }

        $check = RolePermission::where('prefix', 'like', $request->route()->getPrefix())
            ->where($method, 1)
            ->where('role_id', auth('sanctum')->id())
            ->first();

        if ($check) {
            return $next($request);
        }

        return \response(['message' => "Don't have permission "], 401);

    }
}
