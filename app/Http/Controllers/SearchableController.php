<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class SearchableController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'model' => 'required'
        ]);
        $model = $request->model;
        $with = $request->filters['with'];
        try {
            $search = str_replace(' ', '', "\App\Models\ " . "$model")::search($request->filters['search'])->query(function ($builder) use ($with) {
                $builder->with($with);
            })->get()->pluck('id');
            if (request()->page) {
                return response()->json(str_replace(' ', '', "\App\Models\ " . "$model")::with($request->filters['with'])->whereIn('id', $search)->paginate(10));
            }
            return response()->json(str_replace(' ', '', "\App\Models\ " . "$model")::with($request->filters['with'])->whereIn('id', $search)->get());
        } catch (Exception $error) {
            return response()->json($error->getMessage(), 500);
        }
    }
}
