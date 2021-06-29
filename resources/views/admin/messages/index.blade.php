@extends('layouts.app')
@section('content')
<div id="root">
  <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 justify-content-center" style="display: flex">
          <h1>Messaggi ricevuti</h1>
        </div>
       
       
        @foreach($messages as $message)
          
           
                
                <h4 class="card-title text-center">{{$message->sender}}</h4>
                <h4 class="card-title text-center"> {{$message->object}}</h4>
                <p class="card-text text-center">{{$message->content}}</p>
                <div class="commands" style="display:flex;">
                 
                  <form class="delete" action="{{route('admin.messages.destroy', ['message'=>$message->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-primary" name="Delete" value="Delete">
                  </form>
               
        
          @endforeach
        </div>
      </div>
  </div>
</div>
@endsection
@section('foot-script')
