<?php

namespace App\Http\Middleware;

use App\Models\Label;
use App\Models\Project;
use Closure;

class CheckLabelAuthorDelete
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
        if ($request->id !== null) {
            $label = Label::find($request->id);

            if ($request->user()->cannot('delete', $label)) {
                return redirect()
                    ->route('projects')
                    ->withErrors(['not allowed' => 'You cannot delete this label.']);
            }
        }
        return $next($request);
    }
}
