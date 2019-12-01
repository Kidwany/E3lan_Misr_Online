<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Size;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('dashboard.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.supplier.create');
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
            'supplier'            => 'required',
            'owner'               => 'required',
            'letter'              => 'required|max:5|unique:supplier',
        ], [], [
        ]);

        $supplier = new Supplier();
        $supplier->supplier = \request('supplier');
        $supplier->owner = \request('owner');
        $supplier->letter = \request('letter');
        $supplier->save();

        return redirect(adminUrl('supplier'))->with('create', 'Supplier Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('dashboard.supplier.edit', compact('supplier'));
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

        $supplier = Supplier::find($id);

        $request->validate([
            'supplier'            => 'required',
            'owner'               => 'required',
            'letter'              => 'required|max:5',
        ], [], [
        ]);

        $supplier->supplier = \request('supplier');
        $supplier->owner = \request('owner');
        $supplier->letter = \request('letter');
        $supplier->save();

        return redirect(adminUrl('supplier'))->with('update', 'Supplier Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        try
        {
            $supplier->delete();
        }
        catch (\Exception $e)
        {
            Session::flash('exception', 'Error, Can\'t Delete Supplier Because There are related Zones');
            return redirect()->back();
        }

        return redirect(adminUrl('supplier'))->with('delete', 'Supplier Deleted Successfully');
    }
}
