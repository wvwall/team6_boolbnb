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
use Carbon\Carbon;
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
      'promotion_id' => 'required'
    ]);
    $data = $request->all();
    $apartment = Apartment::findOrFail($data['apartment_id']);
    $apartmentId = $apartment->id;
    $promotion = Promotion::findOrFail($data['promotion_id']);
    $promotionId = $promotion->id;
    $now = Carbon::now();
    $end_promotion = $now->addDays(5);
    if($apartment->promotions()->exists($apartmentId)) {
      return redirect()->route('admin.sponsors.index');
    } else {
      $apartment->promotions()->attach($data['promotion_id'], ['end_promotion'=> $end_promotion]);
    }



    return redirect()->route('admin.apartments.index');
  }
}
