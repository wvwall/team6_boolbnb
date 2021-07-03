@extends('layouts.app')
@section('content')
<div class="container bg-dash">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="dash" class="card">
                <div class="card-header">{{ __('La tua Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Benvenuto, ora sei un utente registrato.') }}
                </div>
            </div>
        </div>
        <div class=" btn-dash" style="display: flex">
          <a class="mt-20 btn btn-second" href="{{route('admin.apartments.index')}}"> I tuoi appartamenti </a>
          <a class="mt-20 btn btn-primary" href="{{route('admin.apartments.create')}}"><i class="fas fa-plus"></i> Appartamento</a>
          <a class="mt-20 btn btn-second" href="{{route('admin.messages.index')}}">I tuoi messaggi</a>
        </div>
      </div>
  </div>
@endsection
