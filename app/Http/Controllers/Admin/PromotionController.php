<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UserController;
use App\User;
use Illuminate\Support\Facades\Storage;

use App\Promotion;
use App\Apartment;

class PromotionController extends Controller
{
  public function index()
  {
    $promotions = Promotion::all();
    $apartments = DB::table('apartments')
                  ->where('user_id', '=',  Auth::user()->id)
                  ->get();
    return view('admin.promotions.index', compact('promotions', 'apartments'));
  }

  public function store(Request $request)
  {
    $request->validate([
        'id'=>'exists:promotions,id'
    ]);
    $data = $request->all();
    $apartment = DB::table('apartments')
                  ->where('id', '=', $data['id_apartment'])
                  ->get();
    $promotion = DB::table('promotions')
                  ->where('id','=', $data['id'])
                  ->first();
    $apartment->->promotions()->attach($data['id']);
  }
}
