<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
  public function index()
    {
      return view('guests.apartments.index');
    }
    public function database()
    {
      $apartments = Apartment::all();
      return response()->json([
        'data' => $apartments,
        'success' => true,
      ]);
    }

}
