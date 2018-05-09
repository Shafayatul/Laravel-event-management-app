<?php

namespace App\Http\Controllers;

use App\Event;
use App\Booking;
use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Usermeta;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user = User::find(Auth::id());
        $is_super_admin = $current_user['attributes']['is_super_admin'];
        $user_id = $current_user['attributes']['id'];

        if($is_super_admin){
            $events = Event::orderBy('id','DESC')->get();
        }else{
            $user_events_id = Usermeta::where("user_id",$user_id)->pluck('event_id')->toArray();
            $events = Event::whereIn('id', $user_events_id)->orderBy('id','DESC')->get();
        }        
        return view('home',compact('events'));
    }
}
