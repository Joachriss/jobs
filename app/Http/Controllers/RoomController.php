<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
class RoomController extends Controller
{
    public function index(){
        $roomss = Room::get();
        return view('rooms.index',compact('roomss'));
    }

    public function addnew(){
        Room::create(['name'=>'jdy88']);
        return back();
    } 
}
