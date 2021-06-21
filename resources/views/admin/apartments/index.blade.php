@extends('layouts.app')
@section('content')
<div id="root">
  <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 justify-content-center" style="display: flex">
          <h1>APARTMENTS</h1>
          <a href="{{route('admin.apartments.create')}}">Crea nuovo appartamento</a>
        </div>
        <div class="col-12" style="display: flex; flex-wrap: wrap;">
        @foreach($apartments as $apartment)
          <a href="{{route('admin.apartments.show', ['apartment'=>$apartment->id])}}">
            <div
            class="card"
            style="width: 18rem; margin: 30px 0;">
              <div class="card-body">
                <h5 class="card-title">{{$apartment->title}}</h5>
                <p class="card-text">{{$apartment->city}}</p>
                <p class="card-text">{{$apartment->address}}</p>
                <div class="commands" style="display:flex">
                  <a href="{{route('admin.apartments.edit', ['apartment'=>$apartment->id])}}" class="btn btn-primary">Edit</a>
                  <form class="delete" action="{{route('admin.apartments.destroy', ['apartment'=>$apartment->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-primary" name="Delete" value="Delete">
                  </form>
                </div>
              </div>
            </div>
          </a>
          @endforeach
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
    },
  })
</script>
@endsection

@section('head')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
@endsection
