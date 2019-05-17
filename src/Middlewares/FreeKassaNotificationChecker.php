<?php


namespace Grechanyuk\FreeKassa\Middlewares;


use Closure;
use Grechanyuk\FreeKassa\Facades\FreeKassa;
use Illuminate\Support\Facades\Request;

class FreeKassaNotificationChecker
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(config('freekassa.checkByIPs')) {
            if(!in_array($request->ip(), config('freekassa.allowedIPs'))) {
                return abort(403);
            }
        }

        $sign = Request::input('SIGN');
        $amount = Request::input('AMOUNT');
        $order_id = Request::input('MERCHANT_ORDER_ID');

        if(FreeKassa::checkNotificationSign($sign, $amount, $order_id)) {
            return $next($request);
        }

        return abort(403);
    }
}