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
        $search = $request->filters['search'];
        if (!in_array(
            \Str::lower($model),
            collect(scandir(app_path() . "/Models"))->filter(fn ($qr) => !in_array($qr, ['.', '..']))->map(fn ($qr) => \Str::lower(str_replace('.php', '', $qr)))->toArray()
        )) {
            return response()->json(['message' => 'the model not support or not found😶'], 404);
        }
        try {
            switch ($model) {
                case 'PlanningMachine':
                    return 'oke😁';
                    break;
                default:
                    $query = str_replace(' ', '', "\App\Models\ " . "$model")::search($search)->get()->pluck('id');
                    if (request()->page) {
                        return response()->json(str_replace(' ', '', "\App\Models\ " . "$model")::with($with)->whereIn('id', $query)->paginate(10));
                    }
                    return response()->json(str_replace(' ', '', "\App\Models\ " . "$model")::with($with)->whereIn('id', $query)->get());
            }
        } catch (Exception $error) {
            return response()->json($error->getMessage(), 500);
        }
    }
}
