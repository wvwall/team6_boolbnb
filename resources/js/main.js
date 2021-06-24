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
  },
  mounted(){
    // var coordinate = [apartment['long'], apartment['lat']];
    // this.key = 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv';
    // var map = tt.map({
    //   key : this.key,
    //   container: 'mymap',
    //   center: coordinate,
    //   zoom: 14,
    // });
    // var marker = new tt.Marker().setLngLat(coordinate).addTo(map);
    // map.addControl(new tt.FullscreenControl());
    // map.addControl(new tt.NavigationControl());
  },
  methods:{
    dati:function() {
      this.key = 'mKJsTWCiaSkxZVFnJAoD63ApxgFuCUZv';
      this.indirizzo = this.ins_indirizzo;
      this.citta = this.ins_citta;
      console.log(this.key, this.indirizzo, this.citta);
      axios.get(`https://api.tomtom.com/search/2/search/${this.indirizzo}${this.citta}.json?limit=1&key=${this.key}`).then((response) => {
              this.risposta = response.data.results;
              console.log(this.risposta);
         });
         return this.risposta;
    },
  }
});
<script type="text/javascript">
  var coordinate = [apartment['long'], apartment['lat']];
  var map = tt.map({
    key : api,
    container: 'mymap',
    center: coordinate,
    zoom: 14,
  });

</script>
