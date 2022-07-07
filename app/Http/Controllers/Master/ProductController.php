<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Product::with('customer', 'customer.user')->get());
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
        $record = $request->validate([
            'customer_id' => 'required',
            'part_name' => 'required',
            'part_number' => 'required',
            'cycle_time' => 'required',
            'process' => 'required',
            'type' => 'required',
            'unit' => 'required',
            'maker' => 'required',
            'cavity' => 'required',
            'machine_rate' => 'required',
            'welding_length' => 'required',
            'dies' => 'required',
            'dies_lifetime' => 'required',
        ]);
        DB::beginTransaction();
        try {
            Product::create($record);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
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
        return response()->json(Product::with('customer', 'customer.user')->find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(Product::with('customer', 'customer.user')->find($id));
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
        $record = $request->validate([
            'customer_id' => 'required',
            'part_name' => 'required',
            'part_number' => 'required',
            'cycle_time' => 'required',
            'process' => 'required',
            'type' => 'required',
            'unit' => 'required',
            'maker' => 'required',
            'cavity' => 'required',
            'machine_rate' => 'required',
            'welding_length' => 'required',
            'dies' => 'required',
            'dies_lifetime' => 'required',
        ]);
        DB::beginTransaction();
        try {
            Product::find($id)->update($record);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
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
        return response()->json(Product::find($id)->delete());
    }
}
