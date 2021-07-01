@extends('layouts.app')
@section('content')

<div id="root">
  <div class="container desc">
    <h5 class="title">{{$apartment->title}} </h5>
    <h5 class="city">- {{$apartment->city}} </h5>
  </div>

  <div class="container foto">
    <div id="thumb">
     <img src="{{ asset('storage/' . $apartment->thumb) }}" class="card-img-top" alt="immagine non disponibile">
    </div>
    <div id="msg">
      <div class="row justify-content-center">
            <div id="cont" class="col-md-12 justify-content-center tit" style="display: flex">
              <h4>CONTATTA PROPRIETARIO</h4>
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
              <form class="creamsg" action="{{route('admin.messages.store')}}" method="post" enctype="multipart/form-data" @click="dati">
                @csrf
                @method('POST')
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">La tua Email</label>
                  <input type="text" class="form-control @error('Sender') is-invalid @enderror" id="sender" name="sender" value="">
                  @error('sender')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Oggetto</label>
                  <input type="text" class="form-control @error('Object') is-invalid @enderror" name="object"></input>
                  @error('object')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Messaggio</label>
                  <textarea type="text" class="form-control @error('content') is-invalid @enderror" name="content" ></textarea>
                  @error('content')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label"></label>
                <input type="hidden"  class="form-control-file @error('apartment_id') is-invalid @enderror" id="apartment_id" name="apartment_id" value="{{$apartment->id}}">
                @error('apartment_id')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
                <button class="btn btn-primary" type="submit" name="button">Contatta</button>
              </form>


            </div>
          </div>
    </div>
  </div>
  <div id="info">
    <div class="container info">
      <h4>Informazioni e Servizi</h4>
      <div class="list">
          <div class="left">
            <p class="card-text"><i class="fas fa-map-marker-alt"></i> {{$apartment->address}}</p>
            <p class="card-text"><i class="fas fa-door-open"></i>  Stanze  <b>{{$apartment->n_rooms}}</b></p>
            <p class="card-text"> <i class="fas fa-bed"></i> Letti <b>{{$apartment->n_beds}}</b> </p>
            <p class="card-text"> <i class="fas fa-sink"></i> Bagni <b>{{$apartment->n_bathrooms}}</b> </p>
            <p class="card-text"> <i class="fas fa-ruler-combined"></i>  &#13217; <b>{{$apartment->square_meters}} </b></p>
          </div>
          <div class="right">
          @foreach($apartment->services as $service )
             <p class="card-text"><i class="fas fa-plus"></i> {{ $service->name }}</p>
            @endforeach
          </div>
      </div>

    </div>
   <div id="map">
     <div class="container">
        <button type="button" name="button" @click="getmap({{$apartment->long}}, {{$apartment->lat}})" class="btn btn-primary">Mappa</button>
        <div class="col-md-12 my-4">
        <div id="mymap" style="height: 400px;">

        </div>
      </div>
     </div>
   </div>
  </div>





  <!-- <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 justify-content-center" style="display: flex">
        <a href="{{route('admin.apartments.index')}}" class="btn btn-primary ">Torna indietro</a>
      </div>
      <div class="col-md-3">
          <div class="card" style="width: 18rem;">
            <img src="{{ asset('storage/' . $apartment->thumb) }}" class="card-img-top" alt="immagine non disponibile">
            <div class="card-body">
              <h5 class="card-title">{{$apartment->title}}</h5>
              <p class="card-text"><b>{{$apartment->city}}</b> - <i>{{$apartment->address}}</i></p>
              <p class="card-text"><b>{{$apartment->n_rooms}}</b> Rooms</p>
              <p class="card-text"><b>{{$apartment->n_beds}}</b> Beds</p>
              <p class="card-text"><b>{{$apartment->n_bathrooms}}</b> Bathrooms</p>
              <p class="card-text">{{$apartment->square_meters}} &#13217;</p>
            </div>
            @foreach($apartment->services as $service )
             <p class="card-text"><a href="{{route('service.index', ['id'=>$service->id])}}">#{{ $service->name }}</a></p>
            @endforeach
            <button type="button" name="button" @click="getmap({{$apartment->long}}, {{$apartment->lat}})" class="btn btn-primary">Open Map</button>
          </div>
      </div>
      <div class="col-md-12 my-4">
        <div id="mymap" style="height: 200px;">

        </div>
      </div>
      <div class="col-md-12 my-4">
        <div class="container  my-4">
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
                <button type="submit" name="button">Save</button>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->
@endsection
