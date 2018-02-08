<?php

namespace App\Http\Middleware;

use Closure;

class CopyVerify
{
    /**
     * Handle an incoming request.
     *by momokata
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (config('systeminfo.copyright')==0){
            return $next($request);
        }
        if (!$request->session()->get('authcode')) {
            $url = $request->server('HTTP_HOST');
            $res = file_get_contents('http://sq.freekan.top/check.php?url=' . $url);
            if ($jg = json_decode($res, true)) {
                if ($jg['code'] == 1) {
                    $request->session()->put('authcode', true);
                    return $next($request);
                } else {
                    return redirect('/copytip');
                }
            }

        }else{
            return $next($request);
        }
    }
}
