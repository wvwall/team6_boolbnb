<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\User;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::where(User::all()->id == Apartment::all()->user_id );
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.apartments.create');
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
            'n_rooms' => 'required|numeric',
            'n_beds' => 'required|numeric',
            'n_bathrooms' => 'required|numeric',
            'square_meters' => 'required|numeric',
            'thumb' =>   'nullable|image|max:6000',
            'visibility' => 'required|boolean',
            'users_ids.*' => 'exists:users,id'
          ]);
          
          $data = $request->all();
          if (array_key_exists('thumb', $data)) {
              $thumb = Storage::put('uploads', $data['thumb']);
          }

          $thumb = NULL;
          $apartment = new Apartment();
          $apartment->fill($data);
          /* $data['slug'] = $this->generateSlug($data['title']); */
          $apartment->slug = $this->generateSlug($apartment->title);
          $apartment->thumb = $thumb;
          $apartment->save();

        

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
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        return view('admin.apartments.edit', compact('apartment'));
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
            'title' => 'required|string|max:255|unique:apartments',
            'city' =>   'required|string|max:255',
            'address' =>   'required|string|max:255',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
            'n_rooms' => 'required|numeric',
            'n_beds' => 'required|numeric',
            'n_bathrooms' => 'required|numeric',
            'square_meters' => 'required|numeric',
            'thumb' =>   'nullable|image|max:6000',
            'visibility' => 'required|boolean',
            'users_ids.*' => 'exists:users,id'
          ]);

          $data = $request->all();
            $data['slug'] = $this->generateSlug($data['title'], $apartment->title != $data['title'], $apartment->slug);
            if (array_key_exists('thumb', $data)) {
            $thumb = Storage::put('uploads', $data['thumb']);
            $data['thumb'] = $thumb;
             }
            $apartment->update($data);

          return redirect()->route('admin.apartments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return redirect()->route('admin.apartments.index');
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
