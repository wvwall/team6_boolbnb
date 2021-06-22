<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
  public function index()
    {
      $apartments = Apartment::all();
      return view('guests.apartments.index', compact('apartments'));
    }
    public function database()
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
}
