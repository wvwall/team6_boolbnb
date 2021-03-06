<?php

namespace App\Http\Controllers\Admin;

use App\Message;
use App\Apartament;
use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::all()->where('user_id_apartment','=', Auth::user()->id );
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sender' => 'required|string|max:255',
            'object' => 'required|string|max:255',
            'content' => 'required|string|min:3|max:1000',
            'apartment_id' => 'exists:apartments,id',
            'apartment_title'=>'required|string|max:255',
            'user_id_apartment'=>'required|numeric'
          ]);

          $data = $request->all();
          $message = new Message();


          $message->create($data);
          return redirect()->route('admin.apartments.index');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        $request->validate([
            'sender' => 'required|string|max:255',
            'object' => 'required|string|max:255',
            'content' => 'required|string|min:3|max:1000',
            'id_apartment' => 'exists:apartments,id',
          ]);

          $data = $request->all();


          $message->update($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();
      return redirect()->route('admin.messages.index');
    }
}
