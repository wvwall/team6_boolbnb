@extends('layouts.app')
@section('content')
<div id="root">
  <div class="container">
      <div id="apa" class=" row justify-content-center">
        <div class="col-md-12 " style="display: flex">
          <h1>I TUOI APPARTAMENTI</h1>
        </div>
        <a class=" btn btn-primary" style="margin: 50px 0;" href="{{route('admin.apartments.create')}}"><i class="fas fa-plus"></i> Appartamento</a>
        <a class="col-12 text-center my-4" href="{{route('admin.promotions.index')}}"><i class="fas fa-ad"></i> Sponsorizza Appartamento</a>
        <div class="col-12 card-container-index">
        @foreach($apartments as $apartment)
          <a href="{{route('admin.apartments.show', ['apartment'=>$apartment->id])}}">
            <div
            class="card apartment-card">
            <img class="" src="{{ asset('storage/' . $apartment->thumb) }}"  alt="immagine non disponibile">
            </a>
              <div class="card-body col-12">
               
                <h5 class="card-title text-center">{{$apartment->title}}</h5>
                <h5 class="card-text text-center">{{$apartment->city}}</h5>
               
                <div class="commands" >
                  <a href="{{route('admin.apartments.edit', ['apartment'=>$apartment->id])}}" class="btn btn-second">Modifica</a>
                  <form class="delete" action="{{route('admin.apartments.destroy', ['apartment'=>$apartment->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-third" name="Delete" value="Elimina">
                  </form>
                </div>
              </div>
            </div>
          
          @endforeach
        </div>
      </div>
  </div>
</div>
@endsection
@section('foot-script')
