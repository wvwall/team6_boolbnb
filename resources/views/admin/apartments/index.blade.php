@extends('layouts.app')
@section('content')
<div id="root">
  <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 justify-content-center" style="display: flex">
          <h1>APARTMENTS</h1>
        </div>
        <a class="col-12 text-center my-4" href="{{route('admin.apartments.create')}}">Crea nuovo appartamento</a>
        <div class="col-12 card-container-index">
        @foreach($apartments as $apartment)
          <a href="{{route('admin.apartments.show', ['apartment'=>$apartment->id])}}">
            <div
            class="card">
              <div class="card-body col-12 mx-2">
                <img class="" src="{{ asset('storage/' . $apartment->thumb) }}" width="200">
                <h5 class="card-title text-center">{{$apartment->title}}</h5>
                <p class="card-text text-center">{{$apartment->city}} - {{$apartment->address}}</p>
                <div class="commands" style="display:flex;">
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
