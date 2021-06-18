<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
  public function index()
    {
      $apartments = Apartment::all();
      return response()->json([
        'data' => $apartments,
        'success' => true,
      ]);
    }
}
