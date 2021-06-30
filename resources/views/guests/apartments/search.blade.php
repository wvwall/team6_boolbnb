@extends('layouts.app')
@section('content')

<button type="button" name="button" @click="sortMetersApartment()">Sort</button>
<!-- <a @click="sortMetersApartment(sort)">Ordina per metri quadrati</a> -->

<div class="container h-100 my-4 col-xs-8">

  <div class="d-flex justify-content-center h-100">
    <!-- <form action="/search" method="GET" role="search"> -->
    <div class="searchbar">
        <input class="search_input" type="text"  placeholder="Search..." v-model="nameSearch" @keyup.enter="searchApartment(nameSearch)">
        <a @click="searchApartment(nameSearch)" class="search_icon"><i class="fas fa-key"></i></a>Filtra per Città
    </div>
    <div class="searchbar">
        <input class="search_input" type="text"  placeholder="Search..." v-model="addressInputSearch" @keyup.enter="searchApartmentAddress(addressInputSearch)">
        <a @click="searchApartmentAddress(addressInputSearch)" class="search_icon"><i class="fas fa-key"></i></a>Filtra per Indirizzo
    </div>
    <div class="searchbar">
        <input class="search_input" type="number"  placeholder="Search..." v-model="roomsInputSearch" @keyup.enter="searchApartmentRooms(roomsInputSearch)">
        <a @click="searchApartmentRooms(roomsInputSearch)" class="search_icon"><i class="fas fa-key"></i></a>Filtra per Stanze
    </div>
  <!-- </form> -->
  </div>


  <div class="d-flex justify-content-center h-100">
    <!-- <form action="/search" method="GET" role="search"> -->

    <div class="searchbar">
        <input class="search_input" type="number"  placeholder="Search..." v-model="bathsInputSearch" @keyup.enter="searchApartmentBaths(bathsInputSearch)">
        <a @click="searchApartmentBaths(bathsInputSearch)" class="search_icon"><i class="fas fa-key"></i></a>Filtra per Bagni
    </div>
  <!-- </form> -->
  </div>

  <div class="d-flex justify-content-center h-100">
    <!-- <form action="/search" method="GET" role="search"> -->

  <!-- </form> -->
  </div>

  <div class="d-flex justify-content-center h-100">
    <!-- <form action="/search" method="GET" role="search"> -->

  <!-- </form> -->
  </div>

  <!-- <div class="d-flex justify-content-center h-100">
    <div class="searchbar">
        <input class="search_input" type="number"  placeholder="Search..." v-model="" @keyup.enter="searchApartment(nameSearch)">
        <a @click="searchApartment(nameSearch)" class="search_icon"><i class="fas fa-key"></i>Filtra per Stanze</a>
    </div>
  </div> -->

</div>

<div class="flip-card" v-for="apart in queryApartmentResult" :key='apart.id'>
  <div class="card apartment-card">
    <!-- visualizzare immagine? -->
    <img src="{{ asset('storage/' . @apart['thumb']) }}"  alt="immagine non disponibile">
      <div class="card-body">
        <h5 class="card-title">@{{apart['title']}}</h5>
        <p class="card-text">@{{apart['city']}} - @{{apart['address']}} - @{{apart['n_rooms']}}</p>

        <!-- route show  -->
        <a @click="get_id(apart['id'])"  href="{{route('apartments.show', ['slug'=>@apart['slug']])}}" class="btn btn-primary">Show More</a>

      </div>
  </div>
</div>

@endsection
