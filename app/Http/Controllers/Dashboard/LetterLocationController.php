<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\LetterLocation;

class LetterLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = LetterLocation::get();
        return view('dashboard.Location_letter.index', compact('locations'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_locations = LetterLocation::get();
        return view('dashboard.Location_letter.create', compact('parent_locations'));

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
            'lettername'               => 'required',
            'letter'               => 'required|unique:letter_locations',
        ], [], [
        ]);

        $location = new LetterLocation();
        $location->title_location =  \request('lettername');
        $location->letter =  \request('letter');
        $location->save();

        return redirect(adminUrl('letter-location'))->with('create', 'Zone Created Successfully');
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
        $location = LetterLocation::find($id);
        // $parent_locations = LetterLocation::with('parentLocation_en')->get();
        return view('dashboard.Location_letter.edit', compact('location'));

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
        $location = LetterLocation::find($id);

        $request->validate([
            'lettername'               => 'required',
            'letter'               => 'required',
        ], [], [
        ]);
        $location->title_location = \request('lettername');
        $location->letter = \request('letter');
        $location->save();


        return redirect(adminUrl('letter-location'))->with('update', 'letter Updated Successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = LetterLocation::find($id);
        try{
            $location->delete();
        }
        catch (\Exception $e)
        {
            Session::flash('exception', 'Error, Can\'t Delete letter Because There are related Zones');
            return redirect()->back();
        }

        return redirect(adminUrl('letter-location'))->with('delete', 'letter Deleted Successfully');
    }

}
