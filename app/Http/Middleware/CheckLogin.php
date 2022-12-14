<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (!Auth::check()) {
            return redirect(route('login'));
        }elseif (Auth::check()&&!$this->quyen()){
            return redirect(route('login'));
        }else{
            return $next($request);
        }

    }

    public function quyen(){
        if (!empty(getquyennd())){

        foreach (getquyennd() as $item){
            $quyennd = $item->ngdung;
            }
        }
        if($quyennd === 'sv'){
            return true;
        }
    }
}
