<?php

namespace App\Http\Controllers;

use App\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
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

          return redirect()->route('apartments.index');
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
            'user_id_apartment'=>'required|numeric'
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
