@extends('layouts.app')
@section('content')

<!-- <button type="button" name="button" @click="sortMetersApartment()">Sort</button> -->
<!-- <a @click="sortMetersApartment(sort)">Ordina per metri quadrati</a> -->

<div class="container h-100 my-4 col-xs-8">



  <div class="filter_2 justify-content-center h-100">



  </div>



  <div class="filter_2 ">
      <div class="input-ser">
          <input class="search_input+ mt-20 mb-20" type="search" name="" placeholder="Cerca per indirizzo" v-model="search_generic" @keyup.enter="dati" >
      </div>

      <div class="input-ser">
          <input class="mt-20 mb-20" type="number" name="n_rooms"
                 placeholder="Stanze"  min="1" max="15" v-model="roomsInputSearch">
      </div>

      <div class="input-ser">
          <input class="mt-20 mb-20" type="number" name="n_beds"
                 placeholder="Letti"  min="1" max="15" v-model="bedsInputSearch">
      </div>

      <div class="mt-20 mb-20">
          <input type="range" v-model="range" name="" id="" min="10" max="100">
          <span class="range">@{{range}} Km</span>

      </div>
  </div>
<div class="filter_2">

    <button type="button" name="button" class="mt-20 btn btn-primary" @click="applyFilters();">Filtra  @{{range}}Km </button>
    <button type="button " name="button" class="mt-20 btn btn-second" @click="resetFilters();" :href="`/search/${search_generic}`">Resetta</button>

</div>

<section class="mt-20" id="search">
    <div class="left mt-20 container" >
        <div class="flip-card center" v-for="apart, i in queryApartmentResult" :key='apart.id' v-if="apart.n_rooms >= roomsInputSearch && apart.n_beds >= bedsInputSearch">
            <div class="card apartment-card card-ser mt-20" :style="`background-image: url(/storage/${apart.thumb})`">
                <!-- visualizzare immagine? -->

            </div>
            <div class="mt-20" >

                <h5 class="card-title"><i class="fas fa-home"></i> @{{apart['title']}}</h5>
                <p class="card-text"><i class="fas fa-map-marker-alt"></i> @{{apart['city']}} </p>
                <b>Stanze</b> @{{apart['n_rooms']}} - <b>Bagni</b> @{{apart['n_bathrooms']}} - <b>Letti</b> @{{apart['n_beds']}}
                <span v-for=""></span>
                <a  :href="`/apartments/${apart.slug}`" class=" mb-20 mt-20 btn btn-primary" style="width: 200px;">Mostra</a>


            </div>
        </div>
    </div>
    <div class="right ">
        <div class=" container">

                <div class="mt-20">

                    <div class="col-md-12 mt-20">
                        <div v-if="search_generic != ''" id="mymap" style="height: 70vh; width: 100%; ">

                        </div>
                    </div>
                </div>

        </div>
    </div>
</section>



</div>


<div id="search" class="container ">
  <div class="left">

  </div>
</div>


@endsection
