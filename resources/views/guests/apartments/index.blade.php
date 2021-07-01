@extends('layouts.app')
@section('content')

  <div class="jumbo py-4">
    <div class="justify-content-center">
      <div class="justify-content-center" style="display: flex">
      <div class="container">
        <h1 class="titolone">Le città sono sempre state come le persone, esse mostrano le loro diverse personalità al viaggiatore.</h1>
      </div>

        <!-- <img src="../img/logo-completo.png"  alt="logo-completo"> -->
      </div>

      <div class="container h-100 my-4 col-xs-8">
        <div class="d-flex justify-content-center h-100">
          <div class="searchbar">
            <input class="search_input" type="text" name="" placeholder="Search...">
            <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
          </div>
          <!-- <a href="{{ route('search.advanced') }}" class="btn btn-primary">Cerca il tuo alloggio!</a> -->
        </div>
      </div>
    </div>
  </div>


  <div class="container">
      <div class=" pt-20 row justify-content-center">

        <div class="pt-20 col-md-12 justify-content-center mt-4" style="display: flex">
          <h3>IN EVIDENZA</h3>
        </div>

        <div class=" pt-20 col-12 card-container-index">
        @foreach($apartments as $apartment)
          <div class="card apartment-card">
            <img src="{{ asset('storage/' . $apartment->thumb) }}"  alt="immagine non disponibile">
              <div class="card-body">

                <h5 class="pt-20 card-title"><i class="fas fa-home"></i> {{$apartment->title}}</h5>

                <h5 class="pt-20 card-text"><i class="fas fa-map-marker-alt"></i> {{$apartment->city}} </h5>

                <a @click="get_id(apartment.id)"  href="{{route('apartments.show', ['slug'=>$apartment->slug])}}" class="btn btn-primary">Mostra</a>
              </div>
          </div>
        @endforeach
        </div>

      </div>
  </div>
@endsection
