<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;

class CheckProjectAuthorDelete
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
            $project = Project::find($request->id);

            if ($request->user()->cannot('delete', $project)) {
                return redirect()
                    ->route('projects')
                    ->withErrors(['not allowed' => 'You cannot delete this project.']);
            }
        }
        return $next($request);
    }
}
