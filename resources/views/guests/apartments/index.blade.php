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
          <a href="{{route('guests.apartments.show'), ['apartment'=>$apartment->id]}}">
            <div
            v-for="apartment in apartments"
            :key="apartment.id"
            class="card"
            style="width: 18rem; margin: 30px 0;">
              <div class="card-body">
                <h5 class="card-title">@{{apartment.title}}</h5>
                <p class="card-text">@{{apartment.city}}</p>
                <p class="card-text">@{{apartment.address}}</p>
                <a href="#" class="btn btn-primary">Show</a>
              </div>
            </div>
          </a>
        </div>
      </div>
  </div>
</div>
@endsection

@section('foot-script')
<script type="text/javascript">
  let app = new Vue({
    el: '#root',
    data:{
      apartments:[],
    },
    created(){
      axios.get('http://localhost:8001/api/apartments').then((response)=>{
        this.apartments = response.data.data;
      });
    }
  })
</script>
@endsection

@section('head')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
@endsection
