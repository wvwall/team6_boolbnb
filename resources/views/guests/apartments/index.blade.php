@extends('layouts.app')
@section('content')

  <div class="jumbo py-4">
    <div class="justify-content-center">
      <div class="justify-content-center" style="display: flex">
        <img src="../img/logo-completo.png" alt="logo-completo">
      </div>

      <div class="container h-100 my-4 col-xs-8">
        <div class="d-flex justify-content-center h-100">
          <div class="searchbar">
            <input class="search_input" type="text" name="" placeholder="Search...">
            <a href="#" class="search_icon"><i class="fas fa-key"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="container">
      <div class="row justify-content-center">

        <div class="col-md-12 justify-content-center mt-4" style="display: flex">
          <h3>In Evidenza</h3>
        </div>

        <div class="col-12 card-container-index">
        @foreach($apartments as $apartment)
            <div class="card apartment-card">
              <div class="card-body">
                <img src="{{ asset('storage/' . $apartment->thumb) }}" width="200" alt="immagine non disponibile">
                <h5 class="card-title">{{$apartment->title}}</h5>
                <p>{{$apartment->id}}</p>
                <p class="card-text">{{$apartment->city}} - {{$apartment->address}}</p>
                <a @click="get_id(apartment.id)"  href="{{route('apartments.show', ['slug'=>$apartment->slug])}}" class="btn btn-primary">Show More</a>
              </div>
          </div>
        @endforeach
        </div>
      </div>
  </div>
@endsection
