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
    risposta: [],
    longitudine: 0,
    latitudine: 0,
    service_index : 0,
    userAddress: '',
    userCity: '',
    validAddresses: [],
    mapDisp: false,
    addressChecked: false,
    show: false,
    toggleMap: false,
    old_indirizzo: '',
    old_citta: '',
    queryApartmentResult: [],
    nameSearch: '',
    inputQueryFuz: '',
    inputQueryRooms: '',
    inputQueryBaths: '',
    inputQueryBeds: '',
    inputQuerySortMeters: '',
    addressInputSearch: '',
    roomsInputSearch: '',
    bathsInputSearch: '',
    bedsInputSearch: '',
    apartmentToMap: [],
    sort: 'sort',
    inputQueryFuz1: '',
  },
  mounted() {
    axios.get(`http://localhost:8000/api/apartments/backend?sort`)
        .then((response) => {
          console.log(response.data);
          this.queryApartmentResult = response.data.data;
        });
    },
  methods:{
    dati: function() {
      this.key = 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv';
      this.indirizzo = this.ins_indirizzo;
      this.citta = this.ins_citta;
      console.log(this.key, this.indirizzo, this.citta);
      axios.get(`https://api.tomtom.com/search/2/search/${this.indirizzo}${this.citta}.json?key=${this.key}`).then((response) => {
              this.risposta = response.data.results;
              console.log(this.risposta);
         });
         return this.risposta;
    },
    getmap:function(long, lat) {
      var coordinate = [long, lat];
      this.key = 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv';
      var map = tt.map({
        key : this.key,
        container: 'mymap',
        center: coordinate,
        zoom: 13,
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
              console.log(this.userAddress);
              console.log(this.validAddresses);
         });
         return this.validAddresses;
    },
    saveAddress:function(address){
      this.ins_indirizzo = address.address.freeformAddress;
      this.validAddresses = [];
      this.latitudine = address.position.lat;
      this.longitudine = address.position.lon;
      this.addressChecked=this.ins_indirizzo;
      // console.log(this.ins_lat);
      // console.log(this.ins_lon);

      var coordinate = [this.longitudine, this.latitudine];
      this.key = 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv';
      var map = tt.map({
        key : this.key,
        container: 'mymap',
        center: coordinate,
        zoom: 14,
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
        axios.get(`http://localhost:8000/api/apartments/backend?s=${this.inputQueryFuz}`)
            .then((response) => {
              console.log(response.data);
              this.queryApartmentResult = response.data.data;
            });
      } else {
        axios.get(`http://localhost:8000/api/apartments/backend?`)
            .then((response) => {
              console.log(response.data);
              this.queryApartmentResult = response.data.data;
            });
      }
    },
    searchApartmentAddress: function (input) {
      if (input != '') {
        this.inputQueryFuz = input;
        console.log(this.inputQueryFuz);
        axios.get(`http://localhost:8000/api/apartments/backend?address=${this.inputQueryFuz}`)
            .then((response) => {
              console.log(response.data);
              this.queryApartmentResult = response.data.data;
            });
      } else {
        axios.get(`http://localhost:8000/api/apartments/backend?`)
            .then((response) => {
              console.log(response.data);
              this.queryApartmentResult = response.data.data;
            });
      }
    },
    searchApartmentRooms: function (input) {
      if (input != '') {
        this.inputQueryFuz = input;
        console.log(this.inputQueryFuz);
        axios.get(`http://localhost:8000/api/apartments/backend?n_rooms=${this.inputQueryFuz}`)
            .then((response) => {
              console.log(response.data);
              this.queryApartmentResult = response.data.data;
            });
      } else {
        axios.get(`http://localhost:8000/api/apartments/backend?`)
            .then((response) => {
              console.log(response.data);
              this.queryApartmentResult = response.data.data;
            });
      }
    },
    searchApartmentBaths: function (input) {
      if (input != '') {
        this.inputQueryFuz = input;
        console.log(this.inputQueryFuz);
        axios.get(`http://localhost:8000/api/apartments/backend?n_bathrooms=${this.inputQueryFuz}`)
            .then((response) => {
              console.log(response.data);
              this.queryApartmentResult = response.data.data;
            });
      } else {
        axios.get(`http://localhost:8000/api/apartments/backend?`)
            .then((response) => {
              console.log(response.data);
              this.queryApartmentResult = response.data.data;
            });
      }
    },
    searchApartmentMaps: function () {
    //console.log(this.inputQueryFuz);
    axios.get(`http://localhost:8000/api/apartments/backend?`)
        .then((response) => {
          console.log(response.data);
          this.apartmentToMap = [response.data.data];
        });

    },
    applyFilters: function(input2,input1,input) {
        this.inputQueryBeds = input2;
        this.inputQueryBaths = input1;
        this.inputQueryRooms = input;
        console.log(this.inputQueryBaths, this.inputQueryRooms, this.inputQueryBeds);
        axios.get(`http://localhost:8000/api/apartments/backend?n_bathrooms=${this.inputQueryBaths}&n_rooms=${this.inputQueryRooms}&n_beds=${this.inputQueryBeds}`)
            .then((response) => {
              //console.log(response.data);
              // var searchResApartment = response.data.results;
              this.queryApartmentResult = response.data.data;

              // this.inputQueryFuz = input;
              // console.log(this.inputQueryFuz);
              // axios.get(`http://localhost:8000/api/apartments/backend?n_rooms=${this.inputQueryFuz}`)
              //     .then((response) => {
              //       console.log(response.data);
              //       this.queryApartmentResult = [...this.queryApartmentResult, ...response.data.data];
              //     });
            });
    },
    sortMetersApartment: function () {
        axios.get(`http://localhost:8000/api/apartments/backend?sort`)
            .then((response) => {
              console.log(response.data);
              this.queryApartmentResult = response.data.data;
            });
    },

  }
});
