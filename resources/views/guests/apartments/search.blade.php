@extends('layouts.app')
@section('content')

<!-- <button type="button" name="button" @click="sortMetersApartment()">Sort</button> -->
<!-- <a @click="sortMetersApartment(sort)">Ordina per metri quadrati</a> -->

<div class="container h-100 my-4 col-xs-8">

  <div class="filter justify-content-center h-100">
    <div class="" v-for="city in cities">
      <a  @click="applyFilters(); cambiaPosizione(city);" class="btn btn-primary">Vai a @{{city}}</a>
    </div>
  </div>

  <div class="filter justify-content-center h-100">

    <div class="">
      <input class="mt-20 mrl-10" type="number" name="n_rooms"
       placeholder="Stanze"  min="1" max="15" v-model="roomsInputSearch">
    </div>

    <div class="">
      <input class="mt-20 mrl-10" type="number" name="n_beds"
      placeholder="Letti"  min="1" max="15" v-model="bedsInputSearch">
    </div>

    <div class="mt-3">
      <span>@{{range}} Km</span>
      <input type="range" v-model="range" name="" id="" min="10" max="100">
      <span>100 Km</span>
    </div>
  </div>

  <div class="filter justify-content-center h-100">
    <div class="searchbar">
      <input class="search_input+" type="search" name="" placeholder="Cerca per indirizzo" v-model="search_generic" @keyup.enter="dati" @input="dati">
    </div>
  </div>

  <div class="filter justify-content-center h-100">
    <button type="button " name="button" class="mt-20 btn btn-primary" @click="applyFilters();">Filtra Per Raggio di @{{range}}Km dalla posizione</button>
    <button type="button " name="button" class="mt-20 btn btn-primary" @click="resetFilters();" :href="`/search/${search_generic}`">Resetta Filtri</button>
  </div>

  <!-- <div class="filter justify-content-center h-100">
    <p>Posizione attuale: @{{actual_loc.address.freeformAddress}}</p>
  </div> -->

  <!-- <div class="container h-100 my-4 col-xs-8">
    <div class="d-flex justify-content-center h-100">
      <li
      v-for="result in results.slice(0, 1)"
      @click="search_generic=result.address.freeformAddress, queryApartmentResult=[], applyFilters(), cambiaPosizione(result.address.freeformAddress), getMapLive(actual_loc.long, actual_loc.lat)"
      class="btn">
        <p><i class="fas fa-search" ></i>ricerca per @{{result.address.municipality}} @{{result.address.countrySubdivision}}</p>
      </li>
    </div>
  </div> -->

  <div class=" justify-content-center h-100">
    <div id="map">
      <div class="container">
        <p style="text-align: center;">POSIZIONE ATTUALE</p>
        <div class="col-md-12">
          <div id="mymap" style="height: 200px; width: 300px; margin: 0 auto;">

          </div>
        </div>
      </div>
    </div>
  </div>

</div>


<div id="search" class="container ">
  <div class="left">
    <div class="flip-card" v-for="apart, i in queryApartmentResult" :key='apart.id' v-if="apart.n_rooms >= roomsInputSearch && apart.n_beds >= bedsInputSearch">
      <div class="card apartment-card" :style="`background-image: url(/storage/${apart.thumb})`">
        <!-- visualizzare immagine? -->
        <div class="card-body">
          <a :href="`/apartments/${apart.slug}`">
            <h5 class="card-title">@{{apart['title']}}</h5>
            <p class="card-text">@{{apart['city']}} - @{{apart['address']}} - <b>Stanze</b> @{{apart['n_rooms']}} - <b>Bagni</b> @{{apart['n_bathrooms']}} - <b>Letti</b> @{{apart['n_beds']}}</p>
            <span v-for=""></span>
            <!-- route show  -->
          </a>
          <a  @click="applyFilters(); cambiaPosizione(apart.address); getMapLive(apart.long, apart.lat)" class="btn btn-primary">Spostati qui @{{apart.address}}</a>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
