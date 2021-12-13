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
        return $next($request);
    }
}
