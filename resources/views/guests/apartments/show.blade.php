@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 justify-content-center" style="display: flex">
        <a href="{{route('apartments.index')}}" class="generic-page-link">Torna indietro</a>
      </div>
      <div class="col-md-12">
          <div class="card show-card">
            <img src="{{ asset('storage/' . $apartment->thumb) }}" width="500" style="margin: 0 auto; padding: 20px">
            <div class="card-body">
              <h5 class="card-title">{{$apartment->title}}</h5>
              <p class="card-text"><b>{{$apartment->city}}</b> - <i>{{$apartment->address}}</i></p>
              <p class="card-text"><b>{{$apartment->n_rooms}}</b> Rooms</p>
              <p class="card-text"><b>{{$apartment->n_beds}}</b> Beds</p>
              <p class="card-text"><b>{{$apartment->n_bathrooms}}</b> Bathrooms</p>
              <p class="card-text">{{$apartment->square_meters}} &#13217;</p>
            </div>
          </div>
      </div>
    </div>
</div>
@endsection


@section('head')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
@endsection
