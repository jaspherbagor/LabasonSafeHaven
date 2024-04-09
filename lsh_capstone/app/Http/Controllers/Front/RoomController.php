<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a paginated list of rooms.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve paginated list of rooms
        $room_all = Room::paginate(12);
        
        // Return the view with room data
        return view('front.room', compact('room_all'));
    }

    /**
     * Display the details of a single room.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function single_room($id)
    {
        // Retrieve the details of a single room with its photos
        $single_room_data = Room::with('rRoomPhoto')->where('id', $id)->first();
        
        // Return the view with single room data
        return view('front.room_detail', compact('single_room_data'));
    }
}
