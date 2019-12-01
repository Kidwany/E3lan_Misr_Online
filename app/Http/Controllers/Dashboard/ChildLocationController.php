<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Child_location;
use App\Models\Parent_location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChildLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Child_location::with('childLocation_en')->get();
        return view('dashboard.childLocation.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_locations = Parent_location::with('parentLocation_en')->get();
        return view('dashboard.childLocation.create', compact('parent_locations'));
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
            'location'               => 'required',
            // 'letter'               => 'required',
        ], [], [
        ]);

        $location = new Child_location();
        $location->parent_location_id =  \request('parent_location_id');
        $location->letter =  \request('letter');
        $location->save();

        $location->childLocation_en()->create(['location' => \request('location')]);
        return redirect(adminUrl('child-location'))->with('create', 'Zone Created Successfully');
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
        $location = Child_location::with('childLocation_en')->find($id);
        $parent_locations = Parent_location::with('parentLocation_en')->get();
        return view('dashboard.childLocation.edit', compact('location', 'parent_locations'));
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
        $location = Child_location::with('childLocation_en')->find($id);

        $request->validate([
            'location'               => 'required',
            // 'letter'                 => 'required',
        ], [], [
        ]);
        $location->parent_location_id = \request('parent_location_id');
        $location->letter = \request('letter');
        $location->save();

        $location->childLocation_en()->update(['location' => \request('location')]);

        return redirect(adminUrl('child-location'))->with('update', 'Zone Updated Successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Child_location::with('childLocation_en')->find($id);
        try{
            $location->delete();
        }
        catch (\Exception $e)
        {
            Session::flash('exception', 'Error, Can\'t Delete Zone Because There are related Zones');
            return redirect()->back();
        }

        return redirect(adminUrl('child-location'))->with('delete', 'Zone Deleted Successfully');
    }
}
