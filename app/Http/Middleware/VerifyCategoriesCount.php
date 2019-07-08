<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Category;

class VerifyCategoriesCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Category::all()->count() == 0) {
            session()->flash('error', 'You need to add atleast one category before you can create a post');
            return redirect()->back();
        }

        return $next($request);
    }
}
