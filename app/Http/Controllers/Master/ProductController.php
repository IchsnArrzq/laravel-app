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
        if (request()->page) {
            return response()->json(Product::with('customer', 'customer.user', 'imageables', 'process_productions')->paginate(10));
        }
        return response()->json(Product::with('customer', 'customer.user', 'imageables', 'process_productions')->get());
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
            'customer_id' => 'required',
            'part_name' => 'required',
            'part_number' => 'required',
            'cycle_time' => 'required|numeric',
            'process' => 'required|array',
            'type' => 'required',
            'unit' => 'required',
            'maker' => 'required',
            'cavity' => 'required',
            'machine_rate' => 'required',
            'welding_length' => 'required',
            'dies' => 'required|numeric',
            'dies_lifetime' => 'required|numeric',
        ]);
        DB::beginTransaction();
        try {
            $product = Product::create([
                'customer_id' => $request->customer_id,
                'part_name' => $request->part_name,
                'part_number' => $request->part_number,
                'cycle_time' => $request->cycle_time,
                'type' => $request->type,
                'unit' => $request->unit,
                'maker' => $request->maker,
                'cavity' => $request->cavity,
                'machine_rate' => $request->machine_rate,
                'welding_length' => $request->welding_length,
                'dies' => $request->dies,
                'dies_lifetime' => $request->dies_lifetime,
            ]);
            $product->process_productions()->sync($request->process);
            for ($i = 0; $i < collect($request->images)->count(); $i++) {
                $product->imageables()->create([
                    'path' => $request->images[$i]->store('product', 'public')
                ]);
            }
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
        return response()->json(Product::with('customer', 'customer.user', 'imageables', 'process_productions')->find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(Product::with('customer', 'customer.user', 'imageables', 'process_productions')->find($id));
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
            'customer_id' => 'required',
            'part_name' => 'required',
            'part_number' => 'required',
            'cycle_time' => 'required|numeric',
            'process' => 'required|array',
            'type' => 'required',
            'unit' => 'required',
            'maker' => 'required',
            'cavity' => 'required',
            'machine_rate' => 'required',
            'welding_length' => 'required',
            'dies' => 'required|numeric',
            'dies_lifetime' => 'required|numeric',
        ]);
        DB::beginTransaction();
        try {
            $product = Product::find($id);
            $product->update([
                'customer_id' => $request->customer_id,
                'part_name' => $request->part_name,
                'part_number' => $request->part_number,
                'cycle_time' => $request->cycle_time,
                'type' => $request->type,
                'unit' => $request->unit,
                'maker' => $request->maker,
                'cavity' => $request->cavity,
                'machine_rate' => $request->machine_rate,
                'welding_length' => $request->welding_length,
                'dies' => $request->dies,
                'dies_lifetime' => $request->dies_lifetime,
            ]);
            $product->process_productions()->sync($request->process);
            for ($i = 0; $i < collect($request->images)->count(); $i++) {
                $product->imageables()->create([
                    'path' => $request->images[$i]->store('product', 'public')
                ]);
            }
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
