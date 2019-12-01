<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Billboard_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BillboardTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Billboard_type::all();
        return view('dashboard.billboardType.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.billboardType.create');
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
            'type'            => 'required',
            'letter'               => 'required|unique:billboard_type',
        ], [], [
        ]);

        $type = new Billboard_type();
        $type->type = \request('type');
        $type->letter = \request('letter');
        $type->save();

        return redirect(adminUrl('billboard-type'))->with('create', 'Billboard Type Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = Billboard_type::find($id);
        return view('dashboard.billboardType.edit', compact('type'));
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
        $type = Billboard_type::find($id);

        $request->validate([
            'type'            => 'required',
            'letter'               => 'required',
        ], [], [
        ]);

        $type->type = \request('type');
        $type->letter = \request('letter');
        $type->save();

        return redirect(adminUrl('billboard-type'))->with('create', 'Billboard Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Billboard_type::find($id);
        try
        {
            $supplier->delete();
        }
        catch (\Exception $e)
        {
            Session::flash('exception', 'Error, Can\'t Delete Billboard Type Because There are related Zones');
            return redirect()->back();
        }

        return redirect(adminUrl('billboard-type'))->with('delete', 'Billboard Type Deleted Successfully');
    }
}
