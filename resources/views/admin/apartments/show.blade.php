@extends('layouts.app')
@section('content')

<div id="root">
  <div class="container desc">
    <h5 class="title"><i class="fas fa-home"></i> {{$apartment->title}} </h5>
    <h5 class="city"><i class="fas fa-map-marker-alt"></i> {{$apartment->city}} </h5>
  </div>

  <div class="container foto">
    <div id="thumb">
      <img src="{{ asset('storage/' . $apartment->thumb) }}" class="card-img-top" alt="immagine non disponibile">
    </div>

  </div>
  <div id="info">
    <div class="container info">
      <h4>INFORMAZIONE E SERVIZI</h4>
      <div class="list">
        <div class="left">
          <p class="card-text"><i class="fas fa-map-marker-alt"></i> {{$apartment->address}}</p>
          <p class="card-text"><i class="fas fa-door-open"></i> Stanze <b>{{$apartment->n_rooms}}</b></p>
          <p class="card-text"> <i class="fas fa-bed"></i> Letti <b>{{$apartment->n_beds}}</b> </p>
          <p class="card-text"> <i class="fas fa-sink"></i> Bagni <b>{{$apartment->n_bathrooms}}</b> </p>
          <p class="card-text"> <i class="fas fa-ruler-combined"></i> &#13217; <b>{{$apartment->square_meters}} </b></p>
        </div>
        <div class="right">
          @foreach($apartment->services as $service )
          <p class="card-text"><i class="fas fa-plus"></i> {{ $service->name }}</p>
          @endforeach
        </div>
      </div>

    </div>
    <div id="map">
      <div class="container">
        <button type="button" name="button" @click="getmap({{$apartment->long}}, {{$apartment->lat}})" class="btn btn-primary">Mappa</button>
        <div class="col-md-12 my-4">
          <div id="mymap" style="height: 400px;">

          </div>
        </div>
      </div>
    </div>
  </div>






  @endsection
