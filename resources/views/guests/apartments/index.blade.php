@extends('layouts.app')
@section('content')

<div id="root">


  <div class="jumbo py-4">
    <div class="justify-content-center">
      <div class="justify-content-center" style="display: flex">
        <h1>BoolBnB</h1>
      </div>

      <div class="container h-100 my-4 col-xs-8">
        <div class="d-flex justify-content-center h-100">
          <div class="searchbar">
            <input class="search_input" type="text" name="" placeholder="Search...">
            <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="container">
      <div class="row justify-content-center">

        <div class="col-md-12 justify-content-center mt-4" style="display: flex">
          <h3>In Evidenza</h3>
        </div>

        <div class="col-12 card-container-index">
        @foreach($apartments as $apartment)
            <div class="card">
              <div class="card-body">
                <img src="{{ asset('storage/' . $apartment->thumb) }}" width="200">
                <h5 class="card-title">{{$apartment->title}}</h5>
                <p>{{$apartment->id}}</p>
                <p class="card-text">{{$apartment->city}} - {{$apartment->address}}</p>
                <a @click="get_id(apartment.id)"  href="{{route('apartments.show', ['slug'=>$apartment->slug])}}" class="btn btn-primary">Show More</a>
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
