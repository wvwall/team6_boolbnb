@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 justify-content-center" style="display: flex">
        <a href="{{route('admin.apartments.index')}}">Torna indietro</a>
      </div>
      <div class="col-md-3">
          <div class="card" style="width: 18rem;">
              <img src="{{ asset('storage/' . $apartment->thumb) }}" width="285">
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
    </div>
</div>
@endsection
