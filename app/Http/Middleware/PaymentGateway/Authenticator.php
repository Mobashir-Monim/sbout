<?php

namespace App\Http\Middleware\PaymentGateway;

use Closure;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CoursePurchase;

class Authenticator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $course = Course::find($request->route('course'));
        $purchase = CoursePurchase::find($request->route('purchase'));

        $flag = $request->value_a == hash('sha256', md5(config('payment-gateway.store.secret')) . md5($this->purchase->id));
        $flag = $flag && $request->value_b == hash('sha256', md5(config('payment-gateway.store.secret')) . md5($this->purchase->created_at));
        $flag = $flag && $request->value_c == hash('sha256', md5(config('payment-gateway.store.secret')) . md5($this->purchase->txid));
        
        if ($flag) {
            return $next($request);
        }

        return abort(403, 'Unauthorized');
    }
}
