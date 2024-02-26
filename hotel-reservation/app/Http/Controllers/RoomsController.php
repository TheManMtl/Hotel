<?php

namespace App\Http\Controllers;

use App\Models\Rooms;

class RoomsController extends Controller
{

    public function welcome()
    {

        return view('layouts.guest');

    }

    public function index()
    {

        $list = Rooms::all();

        //dd($list);

        return view('rooms', compact('list'));

    }

}
