<?php

namespace App\Http\Controllers\Admin;
use App\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Apartment;

class ViewController extends Controller

{
  public function index()
    {
      $apartments = Apartment::where('user_id', Auth::id())->get();
      $apartmentId = [];

      foreach ($apartments as $apartment) {
        $apartmentId[] = $apartment['id'];
      }

      $visitors = View::whereIn('apartment_id', $apartmentId)->get();


      return view('admin.visitor', compact('visitors'));
    }
}
