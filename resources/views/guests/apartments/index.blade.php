@extends('layouts.app')
@section('content')
<div id="root">
  <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 justify-content-center" style="display: flex">
        </div>
        @foreach($apartments as $apartment)
        <a href="">
          <div class="col-md-3">
            <div class="card" style="width: 18rem;">
              <img src="" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">{{ $apartment->title }}</h5>
                <p class="card-text">{{ $apartment->city }}</p>
              </div>
            </div>
          </div>
        </a>
        @endforeach
      </div>
  </div>
</div>
<script type="text/javascript">
  let app = new Vue({
    el: '#root',
    data:{
      apartments:[],
    },
    created(){
      axios.get('http://localhost:8000/api/apartments').then((response)=>{
        console.log("ok");
      });
    }
  })
</script>
@endsection
