@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 justify-content-center" style="display: flex">
        <h4>Nuovo appartamento</h4>
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
        <form class="crea" action="{{route('admin.apartments.store')}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('POST')


          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="">
            @error('title')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">City</label>
            <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" v-model="ins_citta"></input>
            @error('city')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Address</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" v-model="ins_indirizzo"></input>
            @error('address')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <button class="btn btn-primary" type="button" name="button" @click="addressSugg(ins_indirizzo, ins_citta)">validate address</button>
          <ul>
            <li class="form-control" @click="saveAddress(addressEl)" class="address-suggestion" v-for="(addressEl, i) in validAddresses" v-if="validAddresses!=[]">
               @{{ addressEl.address.freeformAddress }} - @{{ addressEl.address.streetName }} - @{{ addressEl.address.municipality }}

             </li>
          </ul>

          <div id="mymap" style="height: 300px;">
            <h3>Location</h3>
          </div>

          <div class="coordinate" v-if="addressChecked" hidden>
            <div class="form-group card-custom">
              <input type="text" id="long" name="long" v-bind="longitudine" v-model="longitudine">
            </div>
            <div class="form-group card-custom">
              <input type="text"  id="lat" name="lat" v-bind="latitudine" v-model="latitudine">
            </div>
          </div>



          <!-- s -->
          <button class="btn" type="button" name="button" v-if="addressChecked != ''" v-on:click="show = !show">Next</button>

        <div class="" v-if="show">



          <div class="mb-3" >
            <label for="exampleFormControlInput1" class="form-label">Rooms</label>
            <input type="number" class="form-control @error('n_rooms') is-invalid @enderror" id="n_rooms" name="n_rooms" value="">
            @error('n_rooms')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Beds</label>
            <input type="number" class="form-control @error('n_beds') is-invalid @enderror" id="n_beds" name="n_beds" value="">
            @error('n_beds')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">n_bathrooms</label>
            <input type="number" class="form-control @error('n_bathrooms') is-invalid @enderror" id="n_bathrooms" name="n_bathrooms" value="">
            @error('n_bathrooms')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
            <span>Visible</span>
          <input type="checkbox" name="visibility" class="switch-input" value="1" {{ old('visibility') ? 'checked="checked"' : '' }}/>

          <div class="mb-3" @click="dati">
            <label for="exampleFormControlInput1" class="form-label">Square Meters</label>
            <input type="number" class="form-control-file @error('square_meters') is-invalid @enderror" id="square_meters" name="square_meters" value="">
            <span>m2</span>
            @error('square_meters')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          @foreach($services as $service)
          <div class="mb-3" @click="dati">
            <label for="">{{$service->name}}</label>
            <input type="checkbox" name="service_ids[]" class="switch-input" value="{{$service->id}}" {{ old('service') ? 'checked="checked"' : '' }}/>
          </div>
          @endforeach

          <div class="mb-3">
            <label for="thumb" class="form-label"><b>Upload Main Image</b></label>
            <input type="file" class="form-control-file @error('thumb') is-invalid @enderror" id="thumb" name="thumb" value="" style="">
            <!-- <span>Upload Main Image</span> -->
            @error('thumb')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <!-- <div class="coordinate" v-for="risp in risposta">
            <div class="form-group card-custom">
              <input type="text"  id="long" name="long"  :value="`${risp.position.lon}`">
            </div>
            <div class="form-group card-custom">
              <input type="text"  id="lat" name="lat" :value="`${risp.position.lat}`">
            </div>
          </div> -->

          <button type="submit" name="button" class="btn btn-primary">Save</button>
        </div>
        </form>

      </div>
    </div>
</div>
@endsection
