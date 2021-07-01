@extends('layouts.app')
@section('content')
<div class="container-promotions">
  <div class="row">
    <div class="col-12">
      <div class="links-promotionpage">
        <a href="{{route('admin.apartments.index')}}">Apartmets</a><span> / Promotions</span>
      </div>
    </div>
    <div class="col-12">
      <div class="form-promozioni">
        <h4>Sponsorizza il tuo appartamento!!!</h4>
        <form class="" action="{{route('admin.promotions.store')}}"  method="post">
            @csrf
            @method('POST')
            <div class="form-check">
                <label class="promotions-types" for="promotions"> Scegli la promo: </label>
                @foreach ($promotions as $promotion)
                    <div class="container-promotions-big">
                       <div class="container-promotions-small">
                            <label class="form-check-label promotions-body" for="promotion{{$promotion->id}}">{{$promotion->name}}, {{$promotion->price}}€ - {{$promotion->duration}}giorno/i</label>
                            <input class="form-check-input" type="radio" name="id"  value="{{$promotion->id}}" {{ (is_array(old('promotions')) && in_array($promotion->id, old('promotions'))) ? 'checked' : ''}}>
                        </div>
                    </div>
                @endforeach
                @error('promotions')
                    <span class='alert alert-danger'>
                        {{$message}}
                    </span>
                @enderror
            </div>
            <div class="form-check">
                <label class="promotions-title" for="apartments"> Seleziona una appartamento: </label>
                @foreach ($apartments as $apartment)
                    <div class="container-promotions-big">
                           <div class="container-promotions-small">
                            <label class="form-check-label promotions-body" for="promotion{{$apartment->id}}">{{$apartment->title}}</label>
                            <input class="form-check-input promotions-checkbox"  type="radio" name="id_apartment[]" value="{{$apartment->id}}"
                            {{ (is_array(old('$apartments')) && in_array($apartment->id, old('$apartments'))) ? 'checked' : ''}}>
                        </div>
                    </div>
                @endforeach
                @error('apartment')
                    <span class='alert alert-danger'>
                        {{$message}}
                    </span>
                @enderror
                <button type="submit" name="button">Procedi con il pagamento</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
