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
            <input class="search_input" type="search" name="" placeholder="In Quale Città Vuoi Andare?" v-model="search_generic" @input="dati">
          </div>

        </div>
      </div>


      <div class="container h-100 my-4 col-xs-8">
        <div class="d-flex justify-content-center h-100">
          <li
          v-for="result in results.slice(0, 3)"
          @click="search_generic=result.address.freeformAddress, queryApartmentResult=[]"
          class="btn btn-primary">
            <a :href="`/search/${search_generic}`" class="search_icon"><i class="fas fa-search" ></i>@{{result.address.municipality}}</a>
          </li>
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
        <form id='{{$apartment->id}}' action="{{route('views.store', ['apartment'=>$apartment->id])}}" method="post" style="display: flex; justify-content: center;">
            @csrf
            @method('POST')
          <div  class="card apartment-card">
            <img src="{{ asset('storage/' . $apartment->thumb) }}"  alt="immagine non disponibile">
              <div class="card-body">

                <h5 class="pt-20 card-title"><i class="fas fa-home"></i> {{$apartment->title}}</h5>

                <h5 class=" card-text"><i class="fas fa-map-marker-alt"></i> {{$apartment->city}} </h5>

              </div>
             <!--  onclick="event.preventDefault(); document.getElementById('{{$apartment->id}}').submit()" -->
          </div>
        </form>
        @endforeach
        </div>

      </div>
  </div>
@endsection
