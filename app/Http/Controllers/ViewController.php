<?php

namespace App\Http\Controllers;
use App\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewController extends Controller

{ public function store(Request $request, $apartment)
    {
        $data = $request->all();
        $view = new View();
        
        $view->fill($data);
        $view->ip_address = $_SERVER['REMOTE_ADDR'];
        $view->save();
        
        
        
    }
}
