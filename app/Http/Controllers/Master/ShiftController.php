<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->page){
            return response()->json(Shift::paginate(10));
        }
        return response()->json(Shift::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:shifts'
        ]);
        try {
            Shift::create([
                'name' => $request->name
            ]);
            return response()->json([
                'title' => 'success',
                'message' => 'success create shift'
            ]);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Shift::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(Shift::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:shifts'
        ]);
        try {
            Shift::find($id)->update([
                'name' => $request->name
            ]);
            return response()->json([
                'title' => 'success',
                'message' => 'success update shift'
            ]);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Shift::find($id)->delete();
            return response()->json([
                'title' => 'success',
                'message' => 'success delete shift'
            ]);
        }catch(Exception $exception){
            return response()->json($exception->getMessage());
        }
    }
}
