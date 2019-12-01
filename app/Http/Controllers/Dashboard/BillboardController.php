<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Billboard;
use App\Models\Billboard_calendar;
use App\Models\Billboard_type;
use App\Models\Child_location;
use App\Models\Child_of_child_location;
use App\Models\Image;
use App\Models\Parent_location;
use App\Models\Service;
use App\Models\LetterLocation;
use App\Models\Size;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BillboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billboards = Billboard::all();

        return view('dashboard.billboard.index', compact('billboards'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function billboardmap()
    {
        $billboards = Billboard::select('lat','lng','searchmab')->get();
        $list_array=[];
        foreach($billboards as $key=> $billboard){

            // if($billboard->lat != "" &&  $billboard->lng != ""){
                $list_array[$key]['address']=$billboard->searchmab;
                $list_array[$key]['lat']=$billboard->lat;
                $list_array[$key]['lng']=$billboard->lng;
            // }
        }
        // dd($list_array);
        return view('dashboard.billboard.map', compact('billboards','list_array'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::with('service_en')->where('parent_service_id', null)->get();
        $parentLocations = Parent_location::with('parentLocation_en')->get();
        $sizes = Size::all();
        $types = Billboard_type::all();
        $suppliers = Supplier::all();
        $letters = LetterLocation::all();
        return view('dashboard.billboard.create', compact('services', 'parentLocations', 'sizes', 'suppliers', 'types','letters'));
    }


    public function getChildLocations($id)
    {
        $childLocations = Child_location::with('childLocation_en')->where('parent_location_id', $id)->get();
        return response()->json($childLocations);
    }


    public function getChildOfChildLocations($id)
    {
        $childOfChildLocations = Child_of_child_location::with('childOfChildLocation_en')->where('child_location_id', $id)->get();
        return response()->json($childOfChildLocations);
    }

    public function getSubServices($id)
    {
        $subServices = Service::with('service_en')->where('parent_service_id', $id)->get();
        return response()->json($subServices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();
        $this->validate($request,[
            'image_id.*'                 => 'mimes:jpeg,jpg,png,gif',
            'images.*'                   => 'mimes:jpeg,jpg,png,gif',
            'image_id'                   => 'required',
            'name'                       => 'required',
            // 'code'                       => 'required|max:7',
            'dimensions'                 => 'required',
            'location'                   => 'required|url',
            'service_id'                 => 'required|int',
            'sub_service'                => 'int|nullable',
            'size'                       => 'int',
            'description'                => 'required',
            'type'                       => 'required',
            'supplier'                   => 'required',
            // 'searchmab'                     => 'searchmab',
            // 'lat'                     => 'lat',
            // 'lng'                     => 'lng',
            'parent_location'            => 'required|int',
            'child_location'             => 'int|nullable',
            'child_of_child_location'    => 'int|nullable',
        ], [], [
            'image_id.*'                 => 'Images',
            'images'                     => 'Images',
            'main_services'              => 'Main Services',
            'sub_services'               => 'Sub Services',
            'parent_location'            => 'Location',
            'child_location'             => 'Zone',
            'child_of_child_location'    => 'Area',
        ]);

        //Upload Slide Image
        if ($uploadedFile = $request->file('image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/billboard', $fileName);
            $filePath = 'dashboardImages/billboard/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['image_id'] = $image->id;
        }

        try
        {
            if ($request->hasFile('images'))
            {
                $images = array();
                foreach ($request->images as $image) {

                    $name =  time() . $image->getClientOriginalName();

                    $image->move('dashboardImages/billboard', $name);

                    $path = 'dashboardImages/billboard/' .$name;

                    $image = Image::create(['name' => $name, 'path' => $path]);

                    $input['image_id'] = $image->id;

                    array_push($images, $image->id);
                }
            }
        }
        catch (\Exception $e)
        {
            Session::flash('exception', 'Can\'t Add Images To Billboard');
            return redirect(adminUrl('gallery'));
        }

        $billboard_letter = Billboard::where('letter_id',$request->letter)->get();
        $type = Billboard_type::find($input['type']);
        $LetterLocation = LetterLocation::find($input['letter']);
        $supplier = Supplier::find($input['supplier']);
        $latest_id_add =$billboard_letter->max('id');
        $billboard_letter_latest = Billboard::find($latest_id_add);

        $str = $billboard_letter_latest->code;
        //Extract the numbers using the preg_match_all function.
        preg_match_all('!\d+!', $str, $matches);
        //Any matches will be in our $matches array
        $number =$matches[0][0];

        $code = $LetterLocation->letter.$type->letter.$supplier->letter.++$number;
        // dd($code);

        // $type = Billboard_type::find($input['type']);
        // $supplier = Supplier::find($input['supplier']);
        $zone = Child_location::find(request('child_location'));

        $generatedCode = $code;

        $billboard = new Billboard();
        $billboard->code = $generatedCode;
        $billboard->image_id = $input['image_id'];
        $billboard->service_id = $input['service_id'];
        $billboard->sub_service_id = \request('sub_service');
        $billboard->parent_location_id = $input['parent_location'];
        $billboard->child_location_id = \request('child_location');
        $billboard->child_of_child_location_id = \request('child_of_child_location');
        $billboard->size_id = $input['size'];
        $billboard->location = $input['location'];
        $billboard->dimension = $input['dimensions'];
        $billboard->light = $input['light'];
        $billboard->faces = $input['faces'];
        $billboard->material = $input['material'];
        $billboard->availability = $input['availability'];
        $billboard->price = $input['price'];
        $billboard->type_id = $input['type'];
        $billboard->supplier_id = $input['supplier'];
        $billboard->letter_id = $input['letter'];
        $billboard->searchmab = $input['searchmab'];
        $billboard->lat = $input['lat'];
        $billboard->lng = $input['lng'];
        $billboard->printing_cost = $input['cost_of_printing'];
        $billboard->created_by = Auth::user()->id;
        $billboard->save();

        $billboard->billboard_en()->create(['name' => $input['name'], 'description' => $input['description']]);

        if (!empty($images))
        {
            $billboard->images()->attach($images);
        }

        return redirect(adminUrl('billboard'))->with('create', 'New Bill Board Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $billboard = Billboard::with('image')->find($id);
        return view('dashboard.billboard.show', compact('billboard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $services = Service::with('service_en')->where('parent_service_id', null)->get();
        $subServices = Service::with('service_en')->where('parent_service_id', '!=', null)->get();
        $parentLocations = Parent_location::with('parentLocation_en')->get();
        $childLocations = Child_location::with('childLocation_en')->get();
        $childOfChildLocations = Child_of_child_location::with('childOfChildLocation_en')->get();
        $sizes = Size::all();
        $billboard = Billboard::with('image')->find($id);
        $types = Billboard_type::all();
        $suppliers = Supplier::all();
        $letters = LetterLocation::all();
        return view('dashboard.billboard.edit', compact('types', 'suppliers','letters', 'billboard', 'services', 'subServices', 'parentLocations', 'sizes', 'childLocations', 'childOfChildLocations'));
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
        $billboard = Billboard::with('image')->find($id);
        $input = $request->all();
        $this->validate($request,[
            'image_id'                   => 'mimes:jpeg,jpg,png,gif',
            'images.*'                   => 'mimes:jpeg,jpg,png,gif',
            'name'                       => 'required',
            'dimensions'                 => 'required',
            'location'                   => 'required|url',
            'service_id'                 => 'required|int',
            'type'                       => 'required',
            'supplier'                   => 'required',
            'sub_service'                => 'int|nullable',
            'size'                       => 'int',
            'description'                => 'required',
            'parent_location'            => 'required|int',
            'child_location'             => 'int|nullable',
            'child_of_child_location'    => 'int|nullable',
        ], [], [
            'image_id.*'                 => 'Images',
            'images'                     => 'Images',
            'main_services'              => 'Main Services',
            'sub_services'               => 'Sub Services',
            'parent_location'            => 'Location',
            'child_location'             => 'Zone',
            'child_of_child_location'    => 'Area',
        ]);


        //Upload Slide Image
        if ($uploadedFile = $request->file('image_id'))
        {
            $fileName = time() . $uploadedFile->getClientOriginalName();
            $uploadedFile->move('dashboardImages/billboard', $fileName);
            $filePath = 'dashboardImages/billboard/'.$fileName;
            $image = Image::create(['name' => $fileName, 'path' => $filePath]);
            $input['image_id'] = $image->id;
            $billboard->image_id = $input['image_id'];
        }

        try
        {
            if ($request->hasFile('images'))
            {
                $images = array();
                foreach ($request->images as $image) {

                    $name =  time() . $image->getClientOriginalName();

                    $image->move('dashboardImages/billboard', $name);

                    $path = 'dashboardImages/billboard/' .$name;

                    $image = Image::create(['name' => $name, 'path' => $path]);

                    $input['image_id'] = $image->id;

                    array_push($images, $image->id);
                }
                $billboard->images()->attach($images);
            }
        }
        catch (\Exception $e)
        {
            Session::flash('exception', 'Can\'t Add Images To Billboard');
            return redirect(adminUrl('gallery'));
        }

        $type = Billboard_type::find($input['type']);
        $supplier = Supplier::find($input['supplier']);
        $zone = Child_location::find(request('child_location'));


        $billboard->service_id = $input['service_id'];
        $billboard->sub_service_id = \request('sub_service');
        $billboard->parent_location_id = $input['parent_location'];
        $billboard->child_location_id = \request('child_location');
        $billboard->child_of_child_location_id = \request('child_of_child_location');
        $billboard->size_id = $input['size'];
        $billboard->location = $input['location'];
        $billboard->dimension = $input['dimensions'];
        $billboard->light = $input['light'];
        $billboard->faces = $input['faces'];
        $billboard->material = $input['material'];
        $billboard->availability = $input['availability'];
        $billboard->price = $input['price'];
        $billboard->type_id = $input['type'];
        $billboard->supplier_id = $input['supplier'];
        $billboard->letter_id = $input['letter_id'];
        $billboard->searchmab = $input['searchmab'];
        $billboard->lat = $input['lat'];
        $billboard->lng = $input['lng'];
        $billboard->printing_cost = $input['cost_of_printing'];
        $billboard->created_by = Auth::user()->id;
        $billboard->save();

        $billboard->billboard_en()->update(['name' => $input['name'], 'description' => $input['description']]);

        return redirect(adminUrl('billboard'))->with('update', 'Billboard Has Been Updated Successfully');
    }

    public function billboardImages($id)
    {
        $billboard = Billboard::with('image')->find($id);
        return view('dashboard.billboard.images', compact('billboard'));
    }



    public function deleteBillboardImage($id)
    {
        $image = Image::find($id);
        $image->delete();

        return redirect()->back()->with('delete', 'Image Deleted Successfully');

    }


    public function calendar($id)
    {
        $billboard = Billboard::find($id);
        $appointments = Billboard_calendar::with('billboard')->where('billboard_id', $id)->get();
        return view('dashboard.billboard.calendar', compact('appointments', 'billboard'));
    }

    public function addAppointment(Request $request)
    {
        $this->validate($request,[
            'date_range'                   => 'required',
            'billboard_id'                   => 'required',
        ], [], [
            'image_id.*'                 => 'Images',
        ]);

        $billboardId = \request('billboard_id');

        //Get Dates from Date Range
        $dateRange = explode(' - ', \request('date_range'), 2);
        $from = date("Y-m-d", strtotime($dateRange[0]));
        $to = date("Y-m-d", strtotime($dateRange[1]));

        //Save Appointment
        $billboardCalendar = new Billboard_calendar();
        $billboardCalendar->billboard_id = $billboardId;
        $billboardCalendar->starts = $from;
        $billboardCalendar->end = $to;
        $billboardCalendar->save();

        return redirect()->back()->with('create', 'Reservation Appointment Created Successfully');
    }


    public function deleteAppointment($id)
    {
        $appointment = Billboard_calendar::find($id);
        $appointment->delete();
        return redirect()->back()->with('create', 'Reservation Appointment Deleted Successfully');

    }


    public function destroy($id)
    {
        $billboard = Billboard::with('image')->find($id);
        $billboard->images()->detach();
        $billboard->delete();
        Session::flash('delete', 'Billboard ' . $billboard->id . ' Has Been Deleted Successfully');
        return redirect(adminUrl('billboard'));
    }
}
