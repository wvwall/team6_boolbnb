Vue.config.devtools = true;
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

  },
  mounted(){

  },
  methods:{
    dati:function() {
      this.key = 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv';
      this.indirizzo = this.ins_indirizzo;
      this.citta = this.ins_citta;
      console.log(this.key, this.indirizzo, this.citta);
      axios.get(`https://api.tomtom.com/search/2/structuredGeocode.json?countryCode=IT&streetName=${this.indirizzo}&municipality=${this.citta}&key=${this.key}`)
        .then((response) => {
        console.log(response);
        });
    }
  },
});
