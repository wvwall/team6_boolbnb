@extends('layouts.app')
@section('content')
<div id="root">
  <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 justify-content-center" style="display: flex">
          <h1>APARTMENTS</h1>
        </div>
        <div class="col-12" style="display: flex; flex-wrap: wrap;
        justify-content: space-between;">
        @foreach($apartments as $apartment)
            <div class="card" style="width: 18rem; margin: 30px 0;">
              <div class="card-body">
                <h5 class="card-title">{{$apartment->title}}</h5>
                <p>{{$apartment->id}}</p>
                <p class="card-text">{{$apartment->city}}</p>
                <p class="card-text">{{$apartment->address}}</p>
                <a @click="get_id(apartment.id)"  href="{{route('apartments.show', ['slug'=>$apartment->slug])}}" class="btn btn-primary">Show</a>
              </div>
          </div>
        @endforeach
        </div>
      </div>
  </div>
</div>
@endsection
<!-- @section('foot-script')
<script type="text/javascript">
let app = new Vue({
  el: '#root',
  data:{
    id: null ,
    apartments: [],
  },
  created(){
    axios.get('http://localhost:8001/api/apartments').then((response)=>{
      this.apartments = response.data.data;
    });
  },
  methods:{
    get_id:function(index) {
      this.id = this.index;
      console.log(this.id);
      return this.id;
    }
  },
});
</script>
@endsection -->


@section('head')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
@endsection
