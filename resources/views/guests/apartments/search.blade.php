@extends('layouts.app')
@section('content')

<!-- <button type="button" name="button" @click="sortMetersApartment()">Sort</button> -->
<!-- <a @click="sortMetersApartment(sort)">Ordina per metri quadrati</a> -->

<div class="container h-100 my-4 col-xs-8">

  <div class="d-flex justify-content-center h-100">
    <!-- <form action="/search" method="GET" role="search"> -->
    <div class="searchbar">
      <input class="search_input" type="text" placeholder="Search..." v-model="nameSearch" @keyup.enter="searchApartment(nameSearch)">
      <a @click="searchApartment(nameSearch)" class="search_icon"><i class="fas fa-key"></i></a>Filtra per Città
    </div>
    <div class="searchbar">
      <input class="search_input" type="text" placeholder="Search..." v-model="addressInputSearch" @keyup.enter="searchApartmentAddress(addressInputSearch)">
      <a @click="searchApartmentAddress(addressInputSearch)" class="search_icon"><i class="fas fa-key"></i></a>Filtra per Indirizzo
    </div>
    <!-- </form> -->
  </div>


  <div class="d-flex justify-content-center h-100">
    <!-- <form action="/search" method="GET" role="search"> -->

    <div class="searchbar">
      <input class="" type="number" placeholder="Search..." v-model="bathsInputSearch" @keyup.enter="searchApartmentBaths(bathsInputSearch)">
      <!-- <a @click="searchApartmentBaths(bathsInputSearch)" class="search_icon"><i class="fas fa-key"></i></a> -->
      Bagni
    </div>
    <div class="searchbar">
      <input class="" type="number" placeholder="Search..." v-model="roomsInputSearch" @keyup.enter="searchApartmentRooms(roomsInputSearch)">
      <!-- <a @click="searchApartmentRooms(roomsInputSearch)" class="search_icon"><i class="fas fa-key"></i></a> -->
      Stanze
    </div>
    <div class="searchbar">
      <input class="" type="number" placeholder="Search..." v-model="bedsInputSearch" @keyup.enter="">
      <!-- <a @click="searchApartmentBaths(bathsInputSearch)" class="search_icon"><i class="fas fa-key"></i></a> -->
      Letti
    </div>
    <button type="button" name="button" class="btn btn-primary" @click="applyFilters(bedsInputSearch,bathsInputSearch,roomsInputSearch);">Filtra</button>
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


<!-- <script>
  var firstMap = tt.map({
    key : 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv',
    container: 'mymap',
    center: [17, -34]
    zoom: 14,
  });
  var marker = new tt.Marker().setLngLat(coordinate).addTo(map);
  map.addControl(new tt.FullscreenControl());
  map.addControl(new tt.NavigationControl());


    var firstMap = tt.map({
        key: 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv',
        container: 'firstMap',

        // dragPan: !isMobileOrTablet(),
        center: [17, -34],
    });

    // var secondMap = tt.map({
    //     key: '<your-tomtom-maps-API-key>',
    //     container: 'secondMap',
    //     style: 'tomtom://vector/1/basic-night',
    //     dragPan: !isMobileOrTablet(),
    //     center: [4.899431, 52.379189],
    //     zoom: 12
    // });
    // firstMap.addControl(new tt.FullscreenControl({ container: document.querySelector('firstMap') }));
    // secondMap.addControl(new tt.FullscreenControl({ container: document.querySelector('body') }));
    // firstMap.addControl(new tt.NavigationControl());
    // secondMap.addControl(new tt.NavigationControl());

    new tt.Marker().setLngLat([25.856667, -17.924444]).addTo(firstMap);
    new tt.Marker().setLngLat([23.623112, -19.130979]).addTo(firstMap);
    new tt.Marker().setLngLat([18.403108, -33.957314]).addTo(firstMap);

    firstMap.fitBounds([[17, -34], [27, -15]], { padding: 100, linear: true });
</script> -->

<div id="search" class="container ">
  <div class="left">
    <div class="flip-card" v-for="apart in queryApartmentResult" :key='apart.id'>
      <div class="card apartment-card">
        <!-- visualizzare immagine? -->
        <img src="{{ @apart['thumb'] }}" alt="immagine non disponibile">
        <div class="card-body">
          <h5 class="card-title">@{{apart['title']}}</h5>
          <p class="card-text">@{{apart['city']}} - @{{apart['address']}} - <b>Stanze</b> @{{apart['n_rooms']}} - <b>Bagni</b> @{{apart['n_bathrooms']}} - <b>Letti</b> @{{apart['n_beds']}}</p>

          <!-- route show  -->
          <a @click="get_id(apart['id'])" href="{{route('apartments.show', ['slug'=>@apart['slug']])}}" class="btn btn-primary">Mostra</a>

        </div>
      </div>
    </div>
  </div>
  <div class="right">


  <div id="map">
     <div class="container">
        <button type="button" name="button" @click="searchApartmentMaps()">Mappa</button>
        <div class="col-md-12 my-4">
          <div id="firstMap" style="height: 400px;">


          </div>
      </div>
     </div>
   </div>
  </div>
</div>


@endsection
