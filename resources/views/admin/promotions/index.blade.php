@extends('layouts.app')
@section('content')

<div class="mt-20 pt-20 pb-20 bg-promo container" style="text-align: center;">

    <div>
        <h3 style="margin: 80px 0 50px 0;"> Scegli il piano più adatto a te.</h3>
    </div>
    <form class="mt-20 mb-20" action="{{route('admin.promotions.store')}}" method="post">
        @csrf
        @method('POST')
        <form class="mt-20">
            {{-- Promotions--}}
            <div class="form-check" style="font-size: 1rem;">

                @foreach ($promotions as $promotion)
                <div class="container mb-20 mt-20">
                    <div class="container-promotions-small">
                        <label style="text-transform: capitalize;" for="promotion{{$promotion->id}}"> <span style="color: #ff6147;"  ><i class="fas fa-ad"></i></span> {!!$promotion->name!!} - € {!!$promotion->price!!}</label>
                        <input type="radio" name="promotion_id" id="promotion{{$promotion->id}}" value="{{$promotion->id}}" {{ (is_array(old('promotions')) && in_array($promotion->id, old('promotions'))) ? 'checked' : ''}}>
                    </div>
                </div>
                @endforeach
                @error('promotions')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
                @enderror
            </div>
            {{-- Houses --}}
            <h4 class="mb-20 mt-20"> Scegli l'appartamento da sponsorizzare:</h4>
            <div>

                @foreach ($apartments as $apartment)
                <div >
                    <div>
                        <label class="form-check-label" for="promotion{{$apartment->id}}"> <span style="color: #ff6147;"><i class="fas fa-home"></i></span> {{$apartment->title}}</label>
                        <input style="text-transform: uppercase;" type="radio" name="apartment_id" id="apartment{{$apartment->id}}" value="{{$apartment->id}}" {{ (is_array(old('$apartments')) && in_array($house->id, old('$houses'))) ? 'checked' : ''}}>
                    </div>
                </div>
                @endforeach
                @error('house')
                <span class='alert alert-danger'>
                    {{$message}}
                </span>
                @enderror
            </div>
            <div class="center2 mt-20">
                 <button type="submit" class="mt-20 btn btn-primary "> Procedi al pagamento </button>
            </div>
           
</div>
</div>

<script>
    AOS.init();
</script>

@endsection