<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->page) {
            return response()->json(Customer::with('user')->latest()->paginate(10));
        }
        return response()->json(Customer::with('user')->get());
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
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ])->assignRole('customer')->customer()->create([
                'alias' => $request->alias,
                'pic' => $request->pic,
                'primary' => $request->primary,
                'secondary' => $request->secondary,
                'number_fax' => $request->number_fax,
                'province' => $request->province,
                'city' => $request->city,
                'postcode' => $request->postcode,
                'address' => $request->address,
                'remark' => $request->remark,
            ]);
            DB::commit();
            return response()->json($user);
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
        return response()->json(Customer::with('user')->find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(Customer::with('user')->find($id));
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

        DB::beginTransaction();
        try {
            $customer = Customer::find($id);
            $customer->update([
                'alias' => $request->alias,
                'pic' => $request->pic,
                'primary' => $request->primary,
                'secondary' => $request->secondary,
                'number_fax' => $request->number_fax,
                'province' => $request->province,
                'city' => $request->city,
                'postcode' => $request->postcode,
                'address' => $request->address,
                'remark' => $request->remark,
            ]);
            $customer->user()->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            DB::commit();
            return response()->json('ok');
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
        $customer = Customer::find($id);
        $customer->products()->delete();
        $customer->user()->delete();
        $customer->delete();
        return response()->json($customer);
    }
}
