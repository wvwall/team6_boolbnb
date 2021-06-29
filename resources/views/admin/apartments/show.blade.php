@extends('layouts.app')
@section('content')

<div id="root">
  <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 justify-content-center" style="display: flex">
          <a href="{{route('admin.apartments.index')}}">Torna indietro</a>
        </div>
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
              <img src="{{ asset('storage/' . $apartment->thumb) }}" class="card-img-top" alt="immagine non disponibile">
              <div class="card-body">
                <h5 class="card-title">Title: {{$apartment->title}}</h5>
                <p class="card-text">City: {{$apartment->city}}</p>
                <p class="card-text">Address: {{$apartment->address}}</p>
                <p class="card-text">N Rooms: {{$apartment->n_rooms}}</p>
                <p class="card-text">N Beds: {{$apartment->n_beds}}</p>
                <p class="card-text">N Bathrooms: {{$apartment->n_bathrooms}}</p>
                <p class="card-text">Square meters: {{$apartment->square_meters}}</p>
              </div>
            </div>
        </div>
        <div class="col-md-12">
          <button type="button" name="button" @click="getmap({{$apartment->long}}, {{$apartment->lat}})">mappa</button>
          <div id="mymap" style="height: 300px;">
            <h3>My map</h3>
          </div>
    <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 justify-content-center" style="display: flex">
        <h4>Contatta Proprietario</h4>
      </div>
      <div class="col-md-8 justify-content-center">
        @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
      </div>
      <div class="col-md-8">
        <form class="crea" action="{{route('admin.messages.store')}}" method="post" enctype="multipart/form-data" @click="dati">
          @csrf
          @method('POST')
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Sender</label>
            <input type="text" class="form-control @error('Sender') is-invalid @enderror" id="sender" name="sender" value="">
            @error('sender')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Object</label>
            <input type="text" class="form-control @error('Object') is-invalid @enderror" name="object"></input>
            @error('object')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Content</label>
            <textarea type="text" class="form-control @error('content') is-invalid @enderror" name="content" ></textarea>
            @error('content')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">apartment_id</label>
            <input type="number" class="form-control-file @error('apartment_id') is-invalid @enderror" id="apartment_id" name="apartment_id" value="{{$apartment->id}}">
            @error('apartment_id')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
         

          <button type="submit" name="button">Save</button>
        </form>

      </div>
    </div>
</div>
        </div>
      </div>
  </div>
</div>
@endsection
