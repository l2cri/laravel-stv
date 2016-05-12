<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Facades\AuthUser;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (! $this->checkAdmin())
            return redirect()->guest('/auth/login');

        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/auth/login');
            }
        }

        return $next($request);
    }

    public function checkAdmin(){

        // проверяем что это админка
        $is_backend = (strpos($_SERVER['REQUEST_URI'], "/admin") === 0);
        if (!$is_backend) return true;

        // если пользователь не залогинен в AdminAuth - возврат
        $adminUser = \AdminAuth::user();
        if (!$adminUser) return false;

        // если залогинен, проверяем имеет ли доступ в админку, если нет - выкидываем
        if ( !AuthUser::can('admin') )
        {
            \AdminAuth::logout();
            return false;
        }

        return true;
    }
}
