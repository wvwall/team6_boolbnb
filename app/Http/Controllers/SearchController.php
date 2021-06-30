<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Apartment;
use App\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;



    class SearchController extends Controller {

      public function frontend(){
        return Apartment::all();
      }

      public function backend(Request $request){
        $query = Apartment::query();

        if ($s = $request->input('s')) {
          $query->whereRaw("title LIKE '%" . $s . "%'")
          ->orWhereRaw("city LIKE '%" . $s . "%'");
        }

        if ($add = $request->input('address')) {
          $query->whereRaw("address LIKE '%" . $add . "%'")
          ->orWhereRaw("city LIKE '%" . $add . "%'");
        }

        if ($nRooms = $request->input('n_rooms')) {
          $query->whereRaw("n_rooms = " . $nRooms . "");
        }

        if ($nBath = $request->input('n_bathrooms')) {
          $query->whereRaw("n_bathrooms = " . $nBath . "");
        }

        if ($sort = $request->input('sort')) {
          $query->sortByDesc("square_meters");
        }

        $perPage = 25;
        $page = $request->input('page', 1);
        $total = $query->count();

        $request = $query->offset(($page-1)*$perPage)->limit($perPage)->get();

        return response()->json([
          'data'=> $request,
          'total'=> $total,
          'page'=>$page,
          'last_page'=>ceil($total/$perPage)
        ]);
      }

      // public function backend2(Request $request){
      //
      //   $conditions = collect([]);
      //   $conditions->push($request->only(['title', 'address', 'n_beds', 'n_rooms', 'n_bathrooms']));
      //
      //   Vehicle::where(function($q) use ($conditions){
      //     if ($conditions->has('title')) {
      //       $q->where('title', $conditions->get('title'));
      //     }
      //
      //     return $q;
      //   })->whereHas('address', function($q) use ($conditions) {
      //       return $q->where($conditions->toArray());
      //       })->get();
      //
      //   // return response()->json([
      //   //   'data'=> $request,
      //   //   'total'=> $total,
      //   //   'page'=>$page,
      //   //   'last_page'=>ceil($total/$perPage)
      //   // ]);
      // }

      public function filter(Request $request, Apartment $apartment)
        {
          // Search for a user based on their name.
          if (request()->has('title')) {
              $apartments = Apartment::where('title', request('title'))
              ->paginate(25)
              ->appends('title', request('title'));
          } else {
            $apartments = Apartment::paginate(25);
          }

          // Search for a user based on their company.
          // if ($request->has('city')) {
          //     $apartment->where('city', $request->input('city'));
          // }
          //
          // // Search for a user based on their city.
          // if ($request->has('address')) {
          //     $apartment->where('address', $request->input('address'));
          // }

          // Continue for all of the filters.

          // Get the results and return them.
          return view('guests.apartments.search')
          ->with('apartments', $apartments);
    }
  }
