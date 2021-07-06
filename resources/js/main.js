Vue.config.devtools = true;
import axios from "axios";
let app1 = new Vue({
  el: '#app',
  data:{
    apartments: [],
    appartamento: [],
    key: '',
    citta: '',
    indirizzo: '',
    ins_indirizzo: '',
    ins_citta: '',
    ins_lon: '',
    ins_lat: '',
    results: [],
    longitudine: 0,
    latitudine: 0,
    service_index : 0,
    userAddress: '',
    userCity: '',
    validAddresses: [],
    mapDisp: false,
    addressChecked: false,
    show: false,
    toggleMap: true,
    old_indirizzo: '',
    old_latitude: '',
    old_longitudine: '',
    old_citta: '',
    queryApartmentResult: [],
    nameSearch: '',
    inputQueryFuz: '',
    inputQueryRooms: '',
    inputQueryBaths: '',
    inputQueryBeds: '',
    addressInputSearch: '',
    roomsInputSearch: '',
    bathsInputSearch: '',
    bedsInputSearch: '',
    apartmentToMap: [],
    sort: 'sort',
    inputQueryFuz1: '',

    search_generic: '',
    range: 20,
    cities: [],
    actual_loc: [],
    services: [
      'wifi',
      'auto',
      'vista',
      'portineria',
    ],
  },

  mounted() {
    let path = window.location.pathname;
    this.search_generic = path.split("/search/")[1];
    console.log(this.search_generic);
    this.key = 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv';



    if (this.search_generic != null) {
      //console.log(this.search_generic + '<-url');
      axios.get(`https://api.tomtom.com/search/2/search/${this.search_generic}.json?key=${this.key}`)
          .then((response) => {
            console.log(response.data.results[0].address);
            //this.queryApartmentResult = response.data;
            let lon = response.data.results[0].position.lon;
            let lat = response.data.results[0].position.lat;
            this.longitudine = lon;
            this.latitudine = lat;
            this.actual_loc = response.data.results[0];
            //console.log(lon, lat);
          if (this.cities = []) {
            axios.get(`http://localhost:8000/api/apartments/`)
                .then((response) => {
            for (var i = 0; i < response.data.length; i++) {
                if (!this.cities.includes(response.data[i].city)) {
                  this.cities.push(response.data[i].city)
                }
              }
            });
          }
        });

        this.queryApartmentResult = [];
        axios.get(`http://localhost:8000/api/apartments/`)
            .then((response) => {
              console.log(response.data);
              //this.queryApartmentResult = response.data;
              var coordinate = [response.data[0].long, response.data[0].lat];
              this.key = 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv';
              var map = tt.map({
                key : this.key,
                container: 'mymap',
                center: coordinate,
                zoom: 12,
              });

              var marker = new tt.Marker().setLngLat(coordinate).addTo(map);
              map.addControl(new tt.FullscreenControl());
              map.addControl(new tt.NavigationControl());

          for (var i = 0; i < response.data.length; i++) {
            //console.log(response.data[i].long, response.data[i].lat);
                var range = parseInt(this.range);
                let lat1 = this.latitudine;
                let lon1 = this.longitudine;
                let lat2 = response.data[i].lat;
                let lon2 = response.data[i].long;
                lon1 =  lon1 * Math.PI / 180;
                lon2 = lon2 * Math.PI / 180;
                lat1 = lat1 * Math.PI / 180;
                lat2 = lat2 * Math.PI / 180;

                // Haversine formula
                let dlon = lon2 - lon1;
                let dlat = lat2 - lat1;
                let a = Math.pow(Math.sin(dlat / 2), 2)
                         + Math.cos(lat1) * Math.cos(lat2)
                         * Math.pow(Math.sin(dlon / 2),2);

                let c = 2 * Math.asin(Math.sqrt(a));

                // Radius of earth in kilometers. Use 3956
                // for miles
                let r = 6371;

                let distancekm = (c*r) ;
                //console.log(distancekm);
                console.log(distancekm + 'range: '+ range);
                    if (distancekm <= range) {
                        //this.queryApartmentResult[i] = response.data[i];
                        this.queryApartmentResult.push(response.data[i]);
                        console.log('trovato!' + response.data[i] + distancekm);
                    }
                    //console.log(this.queryApartmentResult);
                }

      });
    } else {
      axios.get(`http://localhost:8000/api/apartments/`)
          .then((response) => {
            console.log(response.data);
            // this.queryApartmentResult = response.data;
            let lon = response.data[0].long;
            let lat = response.data[0].lat;
            this.longitudine = lon;
            this.latitudine = lat;
            this.actual_loc = response.data[0];
            console.log(lon, lat, this.actual_loc);

            for (var i = 0; i < response.data.length; i++) {
              if (!this.cities.includes(response.data[i].city)) {
                this.cities.push(response.data[i].city)
              }
            }

            var coordinate = [this.longitudine, this.latitudine];
            this.key = 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv';
            var map = tt.map({
              key : this.key,
              container: 'mymap',
              center: coordinate,
              zoom: 12,
            });

            var marker = new tt.Marker().setLngLat(coordinate).addTo(map);
            map.addControl(new tt.FullscreenControl());
            map.addControl(new tt.NavigationControl());

            for (var i = 0; i < response.data.length; i++) {
              //console.log(response.data[i].long, response.data[i].lat);
                  var range = parseInt(this.range);
                  let lat1 = this.latitudine;
                  let lon1 = this.longitudine;
                  let lat2 = response.data[i].lat;
                  let lon2 = response.data[i].long;
                  lon1 =  lon1 * Math.PI / 180;
                  lon2 = lon2 * Math.PI / 180;
                  lat1 = lat1 * Math.PI / 180;
                  lat2 = lat2 * Math.PI / 180;

                  // Haversine formula
                  let dlon = lon2 - lon1;
                  let dlat = lat2 - lat1;
                  let a = Math.pow(Math.sin(dlat / 2), 2)
                           + Math.cos(lat1) * Math.cos(lat2)
                           * Math.pow(Math.sin(dlon / 2),2);

                  let c = 2 * Math.asin(Math.sqrt(a));

                  // Radius of earth in kilometers. Use 3956
                  // for miles
                  let r = 6371;

                  let distancekm = (c*r) ;
                  //console.log(distancekm);
                  //console.log(distancekm + 'range: '+ range);
                  this.queryApartmentResult.push(response.data[i]);
                      if (distancekm <= range) {
                          //this.queryApartmentResult[i] = response.data[i];
                          //console.log('trovato!' + response.data[i] + distancekm);
                      }

                      //console.log(this.queryApartmentResult);
                  }

          });
        }
    },

  methods:{
    dati: function() {
      this.key = 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv';
      this.indirizzo = this.search_generic;
      //console.log(this.key, this.indirizzo);
      axios.get(`https://api.tomtom.com/search/2/search/${this.search_generic}.json?key=${this.key}`).then((response) => {
              this.results = response.data.results;
              console.log(this.results[0]);
         });
         this.latitudine = this.results[0].position.lat;
         this.longitudine = this.results[0].position.lon;

         var coordinate = [this.longitudine, this.latitudine];
         this.key = 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv';
         var map = tt.map({
           key : this.key,
           container: 'mymap',
           center: coordinate,
           zoom: 12,
         });
         var marker = new tt.Marker().setLngLat(coordinate).addTo(map);
         map.addControl(new tt.FullscreenControl());
         map.addControl(new tt.NavigationControl());

         return this.results;
    },

    getCoordinates: function(latitudine, longitudine){
      this.latitudine = latitudine;
      this.longitudine = longitudine;
      this.results = [];

    },

    getmap:function(long, lat) {
      var coordinate = [long, lat];
      this.key = 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv';
      var map = tt.map({
        key : this.key,
        container: 'mymap',
        center: coordinate,
        zoom: 12,
      });
      var marker = new tt.Marker().setLngLat(coordinate).addTo(map);
      map.addControl(new tt.FullscreenControl());
      map.addControl(new tt.NavigationControl());
      this.toggleMap = false;
    },

    selected:function(index) {
      this.service_index = index;
    },

    addressSugg:function(address, city) {
      this.userAddress = address;
      this.userCity = city;
      this.key = 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv';
      axios.get(`https://api.tomtom.com/search/2/search/${this.userAddress}%20${this.userCity}.json?key=${this.key}`).then((response) => {
              this.validAddresses = response.data.results;
              // console.log(this.userAddress);
              // console.log(this.validAddresses);
         });
         return this.validAddresses;
    },

    saveAddress:function(address){
      this.ins_indirizzo = address.address.freeformAddress;
      this.ins_citta = address.address.municipality;
      this.validAddresses = [];
      this.latitudine = address.position.lat;
      this.longitudine = address.position.lon;
      this.addressChecked = this.ins_indirizzo;
      this.userCity = address.address.municipality;

      // console.log(this.ins_lat);
      // console.log(this.ins_lon);

      var coordinate = [this.longitudine, this.latitudine];
      this.key = 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv';
      var map = tt.map({
        key : this.key,
        container: 'mymap',
        center: coordinate,
        zoom: 12,
      });
      var marker = new tt.Marker().setLngLat(coordinate).addTo(map);
      map.addControl(new tt.FullscreenControl());
      map.addControl(new tt.NavigationControl());

      this.mapDisp = true;
    },

    searchApartment: function (input) {
      if (input != '') {
        this.inputQueryFuz = input;
        console.log(this.inputQueryFuz);
        axios.get(`http://localhost:8000/api/apartments/search/${this.inputQueryFuz}`)
            .then((response) => {
              console.log(response.data);
              this.queryApartmentResult = response.data;
            });
      } else {
        axios.get(`http://localhost:8000/api/apartments/`)
            .then((response) => {
              console.log(response.data);
              this.queryApartmentResult = response.data;
            });
      }
    },

    applyFilters: function() {
      this.queryApartmentResult = [];
      axios.get(`http://localhost:8000/api/apartments/`)
          .then((response) => {
            //console.log(response.data);
            //this.queryApartmentResult = response.data;

      for (var i = 0; i < response.data.length; i++) {
        //console.log(response.data[i].long, response.data[i].lat);
            var range = parseInt(this.range);
            let lat1 = this.latitudine;
            let lon1 = this.longitudine;
            let lat2 = response.data[i].lat;
            let lon2 = response.data[i].long;
            lon1 =  lon1 * Math.PI / 180;
            lon2 = lon2 * Math.PI / 180;
            lat1 = lat1 * Math.PI / 180;
            lat2 = lat2 * Math.PI / 180;

            // Haversine formula
            let dlon = lon2 - lon1;
            let dlat = lat2 - lat1;
            let a = Math.pow(Math.sin(dlat / 2), 2)
                     + Math.cos(lat1) * Math.cos(lat2)
                     * Math.pow(Math.sin(dlon / 2),2);

            let c = 2 * Math.asin(Math.sqrt(a));

            // Radius of earth in kilometers. Use 3956
            // for miles
            let r = 6371;

            let distancekm = (c*r) ;
            //console.log(distancekm);
            console.log(distancekm + 'range: '+ range);
                if (distancekm <= range) {
                    //this.queryApartmentResult[i] = response.data[i];
                    this.queryApartmentResult.push(response.data[i]);
                    console.log('trovato!' + response.data[i] + distancekm);
                }

                //console.log(this.queryApartmentResult);
            }
      });
    },

    resetFilters: function() {
      this.range = 20;
      axios.get(`http://localhost:8000/api/apartments/`)
          .then((response) => {
            console.log(response.data);
            this.queryApartmentResult = response.data;
            // console.log(this.queryApartmentResult);
          });

      this.bedsInputSearch = null;
      this.roomsInputSearch = null;
      this.search_generic = '';
    },

    radiusFilter: function() {
      this.queryApartmentResult = [];
      axios.get(`http://localhost:8000/api/apartments/`)
          .then((response) => {
            //console.log(response.data);
            //this.queryApartmentResult = response.data;

      for (var i = 0; i < response.data.length; i++) {
        //console.log(response.data[i].long, response.data[i].lat);
            var range = parseInt(this.range);
            let lat1 = this.latitudine;
            let lon1 = this.longitudine;
            let lat2 = response.data[i].lat;
            let lon2 = response.data[i].long;
            lon1 =  lon1 * Math.PI / 180;
            lon2 = lon2 * Math.PI / 180;
            lat1 = lat1 * Math.PI / 180;
            lat2 = lat2 * Math.PI / 180;

            // Haversine formula
            let dlon = lon2 - lon1;
            let dlat = lat2 - lat1;
            let a = Math.pow(Math.sin(dlat / 2), 2)
                     + Math.cos(lat1) * Math.cos(lat2)
                     * Math.pow(Math.sin(dlon / 2),2);

            let c = 2 * Math.asin(Math.sqrt(a));

            // Radius of earth in kilometers. Use 3956
            // for miles
            let r = 6371;

            let distancekm = (c*r) ;
            //console.log(distancekm);

                if (distancekm <= range) {
                    //this.queryApartmentResult[i] = response.data[i];
                    this.queryApartmentResult.push(response.data[i]);
                    //console.log('trovato!' + response.data[i] + distancekm);
                }
                //console.log(this.queryApartmentResult);
            }
      });
    },

    getShowUrl: function (input) {
      // this.urlShowSearch = "{{route('apartments.show', ['slug'=>"+input['slug']"])}}";
      return this.urlShowSearch;
    },

    cambiaPosizione: function (city){
      this.key = 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv';
      //console.log(this.key, this.indirizzo);
      axios.get(`https://api.tomtom.com/search/2/search/${city}.json?key=${this.key}`).then((response) => {
              this.results = response.data.results;
              console.log(this.results[0]);
              this.latitudine = this.results[0].position.lat;
              this.longitudine = this.results[0].position.lon;
              this.search_generic = this.results[0].address.freeformAddress;
              this.actual_loc_lat = this.results[0];

              //console.log(this.latitudine + 'long'+this.longitudine + this.search_generic);
         });

         var coordinate = [this.longitudine, this.latitudine];
         this.key = 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv';
         var map = tt.map({
           key : this.key,
           container: 'mymap',
           center: coordinate,
           zoom: 12,
         });
         var marker = new tt.Marker().setLngLat(coordinate).addTo(map);
         map.addControl(new tt.FullscreenControl());
         map.addControl(new tt.NavigationControl());

         this.search_generic = '';
         this.results = [];
    },

    allApartments: function (){
      this.range = 20;
      axios.get(`http://localhost:8000/api/apartments/`)
          .then((response) => {
            console.log(response.data + ' workssss');
            this.queryApartmentResult = response.data;
            this.actual_loc = response.data[0];
            // console.log(this.queryApartmentResult);
          });
    },

    getMapLive: function () {
      //console.log(this.actual_loc);
      var coordinate = [this.longitudine, this.latitudine];
      this.key = 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv';
      var map = tt.map({
        key : this.key,
        container: 'mymap',
        center: coordinate,
        zoom: 12,
      });
      var marker = new tt.Marker().setLngLat(coordinate).addTo(map);
      map.addControl(new tt.FullscreenControl());
      map.addControl(new tt.NavigationControl());

      for (var i = 0; i < this.queryApartmentResult.length; i++) {
        var marker = new tt.Marker({ element: element })
                    .setLngLat([lon1, lat1])
                    .addTo(this.$map);
      }
    }

  }
});
