@extends('layouts.app')
@section('content')
<div id="root">
  <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 justify-content-center" style="display: flex">
          <h1>MESSAGES</h1>
        </div>
       
        <div class="col-12 card-container-index">
        @foreach($messages as $message)
          
            <div
            class="card apartment-card">
              <div class="card-body col-12 mx-2">
                
                <h2 class="card-title text-center">{{$message->sender}}</h2>
                <h4 class="card-title text-center"> {{$message->object}}</h4>
                <p class="card-text text-center">{{$message->content}}</p>
                <div class="commands" style="display:flex;">
                 
                  <form class="delete" action="{{route('admin.messages.destroy', ['message'=>$message->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-primary" name="Delete" value="Delete">
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
