@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 justify-content-center" style="display: flex">
        <h4>Modifica appartamento</h4>
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
      <img src="{{ asset('storage/' . $apartment->thumb) }}" class="card-img-top" style="width: 250px;" alt="immagine non disponibile">
        <form class="crea" action="{{route('admin.apartments.update', ['apartment' => $apartment->id])}}" method="post" enctype="multipart/form-data" @click="dati">
          @csrf
          @method('PATCH')
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"  placeholder="{{ old('title', $apartment->title) }}" value="{{ old('title', $apartment->title) }}">
            @error('title')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">City</label>
            <input type="text" class="form-control @error('city') is-invalid @enderror" placeholder="{{ old('city', $apartment->city) }}" value="{{ old('city', $apartment->city) }}" name="city" v-model="ins_citta"></input>
            @error('city')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Address</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" placeholder="{{ old('address', $apartment->address) }}" value="{{ old('address', $apartment->address) }}" name="address" v-model="ins_indirizzo"></input>
            @error('address')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>


          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Rooms</label>
            <input type="number" class="form-control-file @error('n_rooms') is-invalid @enderror" id="n_rooms" name="n_rooms" placeholder="{{ old('n_rooms', $apartment->n_rooms) }}" value="{{ old('n_rooms', $apartment->n_rooms) }}">
            @error('n_rooms')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Beds</label>
            <input type="number" class="form-control-file @error('n_beds') is-invalid @enderror" id="n_beds" name="n_beds" placeholder="{{ old('n_beds', $apartment->n_beds) }}" value="{{ old('n_beds', $apartment->n_beds) }}">
            @error('n_beds')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">n_bathrooms</label>
            <input type="number" class="form-control-file @error('n_bathrooms') is-invalid @enderror" id="n_bathrooms" name="n_bathrooms" placeholder="{{ old('n_bathrooms', $apartment->n_bathrooms) }}" value="{{ old('n_bathrooms', $apartment->n_bathrooms) }}">
            @error('n_bathrooms')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">

          <!-- <div class="mb-3">
            <div class="bootstrap-switch-square">
              <input type="checkbox" data-toggle="switch" name="visibility" id="visibility" value="True"/>
              <label for="">Visibility</label>
            </div>
          </div> -->
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Square Meters</label>
            <input type="number" class="form-control-file @error('square_meters') is-invalid @enderror" id="square_meters" name="square_meters" placeholder="{{ old('square_meters', $apartment->square_meters) }}" value="{{ old('square_meters', $apartment->square_meters) }}">
            <span>m2</span>
            @error('square_meters')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          @foreach($services as $service)
          <div class="mb-3" @click="dati">
            <label for="">{{$service->name}}</label>
            <input type="checkbox" name="service_ids" class="switch-input" value="1" {{ old('service') ? 'checked="checked"' : '' }}/>
          </div>
          @endforeach
          <div class="mb-3">
            <label for="thumb" class="form-label">Thumb</label>
            <input type="file" class="form-control-file @error('thumb') is-invalid @enderror" id="thumb" name="thumb" value="">
            <span>Upload Main Image</span>
            @error('thumb')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="coordinate" v-for="risp in risposta">
            <div class="form-group card-custom">
              <input type="text"  id="long" name="long"  :value="`${risp.position.lon}`">
            </div>
            <div class="form-group card-custom">
              <input type="text"  id="lat" name="lat" :value="`${risp.position.lat}`">
            </div>
          </div>

          <button type="submit" name="button">Save</button>
        </form>
      </div>
    </div>
</div>
@endsection
