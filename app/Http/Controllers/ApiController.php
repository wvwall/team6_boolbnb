<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Service;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Apartment::all();
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
          'title' => 'required|string|max:255|unique:apartments',
          'city' =>   'required|string|max:255',
          'address' =>   'required|string|max:255',
          'lat' => 'required|numeric',
          'long' => 'required|numeric',
          'n_rooms' => 'numeric',
          'n_beds' => 'numeric',
          'n_bathrooms' => 'required|numeric',
          'square_meters' => 'required|numeric',
          'thumb' =>   'nullable|image|max:6000',
          'users_id' => 'exists:users,id|nullable',
          'service_ids.*' => 'exists:services,id',
        ]);

        return Apartment::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //$apartment_services = Service::where('apartment_id', '=', $id);

      return Apartment::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $apartment = Apartment::find($id);
        $apartment->update($request->all());
        return $apartment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($title)
    {
        return Apartment::where('title', 'like', '%'.$title.'%')
        ->orWhere('address', 'like', '%'.$title.'%')->get();
    }

    public function searchRooms($rooms)
    {
        return Apartment::where('n_rooms', '=', $rooms)->get();
    }

    public function searchBaths($baths)
    {
        return Apartment::where('n_bathrooms', '=', $baths)->get();
    }

    public function searchBeds($beds)
    {
        return Apartment::where('n_beds', '=', $beds)->get();
    }

    public function multiSearch(Request $request)
    {
        return Apartment::where('n_bathrooms', '=', $request->input('n_bathrooms'))
        ->andWhere('n_rooms', '=', $request->input('n_rooms'))
        ->andWhere('n_beds', '=', $request->input('n_beds'))->get();
    }

    public function findNearestApartment($latitude, $longitude, $radius = 400)
    {
        /*
         * replace 6371000 with 6371 for kilometer and 3956 for miles
         */
        $apartment = Apartment::selectRaw("id, title, address, lat, long,
                         ( 6371000 * acos( cos( radians(?) ) *
                           cos( radians( lat ) )
                           * cos( radians( long ) - radians(?)
                           ) + sin( radians(?) ) *
                           sin( radians( lat ) ) )
                         ) AS distance", [$latitude, $longitude, $latitude])
            ->having("distance", "<", $radius)
            ->orderBy("distance",'asc')
            ->offset(0)
            ->limit(20)
            ->get();

        return $apartment;
    }

    public function getServices(){
      return Apartment::where('visibility', '=', 0)->get();
    }
}
