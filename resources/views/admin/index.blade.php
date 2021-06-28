@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
        <div class="col-md-8 justify-content-center" style="display: flex">
          <a href="{{route('admin.apartments.index')}}">Your apartments - </a>
          <a href="{{route('admin.messages.index')}}">Your messages</a>
        </div>
      </div>
  </div>
@endsection
