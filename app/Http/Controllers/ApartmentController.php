<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Promotion;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
      /* $promotions = Promotion::all();
      foreach($promotions as $promotion) {
        $apartments = $promotion->apartments()->get();
      }
      dd($apartments); */
      $apartments = Apartment::all()->where('visibility', '=' , '1');
      return view('guests.apartments.index', compact('apartments'));

      $apartamento = DB::table('apartment_promotion')
                    ->where('apartment_id', '=', $apartmentId)
                    ->get();
      dd($apartamento);
      foreach ($apartamento as $key => $app) {
        $idapp = $app->apartment_id;
      }
      $apartments = Apartment::all()->where('id','=', $idapp );
      return view('guests.apartments.index', compact('apartments'));
    }

    public function indexdb()
    {
      $apartments = Apartment::all();
      return response()->json([
        'data' => $apartments,
        'success' => true,
      ]);
    }

    public function show(string $slug)
    {
      $apartment = Apartment::where('slug', '=', $slug)->first();
      return view('guests.apartments.show', compact('apartment'));
    }


    public function showdb(Apartment $apartment, $slug)
    {
      $apartment = Apartment::where('slug', '=', $slug);
      return response()->json([
        'data' => $apartment,
        'success' => true,
      ]);
    }

    public function indexAll(Request $response)
    {
      $apartments = Apartment::all()->toJson();
      return view('guests.apartments.search')->with('apartments', json_decode($apartments, true));
    }

}
