<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckDoanLogin
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
            return redirect(route('logind'));
        }elseif (Auth::check()&&!$this->quyen()){
            return redirect(route('logind'));
        }else{
            return $next($request);
        }
    }

    public function quyen(){
        if (!empty(getquyennd())){

        foreach (getquyennd() as $item){
            $quyennd = $item->ngdung;
            // $ten = $item->tentk;
            }
        }
        if($quyennd === 'doan'){
            return true;
        }
    }
}
