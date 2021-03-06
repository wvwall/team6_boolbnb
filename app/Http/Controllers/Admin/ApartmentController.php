<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Service;
use App\User;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $apartments = DB::table('apartments')
                    ->where('user_id', '=',  Auth::user()->id)
                    ->get();

      return view('admin.apartments.index', compact('apartments'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $services = Service::all();

        return view('admin.apartments.create',compact('services'));
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
            'thumb' =>   'required|max:6000',
            'visible' => 'boolean',
            'users_id' => 'exists:users,id|nullable',
            'service_ids.*' => 'exists:services,id',
          ]);

          $data = $request->all();

          if (array_key_exists('thumb', $data)) {
              $thumb = Storage::put('uploads', $data['thumb']);
          }

          $apartment = new Apartment();
          $apartment->fill($data);
          $apartment->thumb = $thumb;

          $apartment->slug = $this->generateSlug($apartment->title);
          $apartment->save();

          if (array_key_exists('service_ids', $data)) {
            $apartment->services()->attach($data['service_ids']);
          }

          return redirect()->route('admin.apartments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {

        $this->authorize('view', $apartment);

        $message = Message::where('apartment_id', $apartment->id)->count(); //mess su annuncio

        return view('admin.apartments.show', compact('apartment', 'message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();
        $this->authorize('restore', $apartment);
        return view('admin.apartments.edit', compact('apartment','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
      $request->validate([
          'title' => 'required|string|max:255',
          'city' =>   'required|string|max:255',
          'address' =>   'required|string|max:255',
          'lat' => 'nullable|numeric',
          'long' => 'nullable|numeric',
          'n_rooms' => 'numeric',
          'n_beds' => 'numeric',
          'n_bathrooms' => 'required|numeric',
          'square_meters' => 'required|numeric',
          'thumb' =>   'image|max:6000',
          'visibility' => 'nullable|boolean',
          'users_id' => 'exists:users,id|nullable',
        ]);

          $this->authorize('restore', $apartment);
          $data = $request->all();
        

          $data['slug'] = $this->generateSlug($data['title'], $apartment->title != $data['title'], $apartment->slug);
          if (array_key_exists('thumb', $data)) {
            $thumb = Storage::put('uploads', $data['thumb']);
            $data['thumb'] = $thumb;
          }
          $apartment->update($data);

          if(array_key_exists('service_ids', $data)){
            $apartment->services()->sync($data['service_ids']);
        } else {
            $apartment->services()->detach();
        }

          return redirect()->route('admin.apartments.index', compact('apartment'))->with('status', 'Annuncio modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->services()->detach();
        $apartment->messages()->delete();
        $apartment->promotions()->detach();
        $apartment->delete();

        return redirect()->route('admin.apartments.index')->with('status', 'Annuncio cancellato con successo');
    }
    private function generateSlug(string $title, bool $change = true, string $old_slug = '') {
        if (!$change) {
          return $old_slug;
        }
        $slug = Str::slug($title,'-');
        $slug_base = $slug;
        $contatore = 1;
        $apartment_with_slug = Apartment::where('slug','=',$slug)->first();
        while($apartment_with_slug) {
          $slug = $slug_base . '-' . $contatore;
          $contatore++;
          $apartment_with_slug = Apartment::where('slug','=',$slug)->first();
      }
        return $slug;
  }


}
