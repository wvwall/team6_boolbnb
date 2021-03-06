@extends('layouts.app')
@section('content')
<div id="root">
  <div class="container">
    <div class="row justify-content-center">
      <div class=" mex1 col-md-12 "  style="text-align: center;">
        <h3>MESSAGGI RICEVUTI</h3>
      </div>
      @foreach($messages as $message)
      <div class="mex " style="border-radius: 10px;">

        <div class="casella">
          <div class="red">Mittente</div>
          <div>
            <h6 class="card-title text-center">{{$message->sender}}</h6>
          </div>
        </div>
        <div class="casella">
          <div class="red">Oggetto</div>
          <div>
            <h6 class="card-title text-center">{{$message->object}}</h6>
          </div>
        </div>
        <div class="casella">
          <div class="red">Messaggio</div>
          <div>
            <h6 class="card-title text-center">{{$message->content}}</h6>
          </div>
        </div>
        <div class="casella">
          <div class="red">Appartamento</div>
          <div>
            <h6 class="card-title text-center">{{$message->apartment_title}}</h6>
            
          </div>
        </div>


        <div class="casella commands" style="display:flex;">

          <form class="delete" action="{{route('admin.messages.destroy', ['message'=>$message->id])}}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" class=" mt-20 mb-20 btn btn-third" name="Delete" value="Elimina">
          </form>

        </div>

      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
@section('foot-script')