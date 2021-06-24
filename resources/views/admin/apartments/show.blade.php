@extends('layouts.app')
@section('content')

<div id="root">
  <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 justify-content-center" style="display: flex">
          <a href="{{route('admin.apartments.index')}}">Torna indietro</a>
        </div>
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
              <img src="{{ asset('storage/' . $apartment->thumb) }}" class="card-img-top" alt="immagine non disponibile">
              <div class="card-body">
                <h5 class="card-title">Title: {{$apartment->title}}</h5>
                <p class="card-text">City: {{$apartment->city}}</p>
                <p class="card-text">Address: {{$apartment->address}}</p>
                <p class="card-text">N Rooms: {{$apartment->n_rooms}}</p>
                <p class="card-text">N Beds: {{$apartment->n_beds}}</p>
                <p class="card-text">N Bathrooms: {{$apartment->n_bathrooms}}</p>
                <p class="card-text">Square meters: {{$apartment->square_meters}}</p>
              </div>
            </div>
        </div>
        <div class="col-md-12">
          <button type="button" name="button" @click="getmap({{$apartment->long}}, {{$apartment->lat}})">mappa</button>
          <div id="mymap" style="height: 300px;">
            <h3>My map</h3>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection
