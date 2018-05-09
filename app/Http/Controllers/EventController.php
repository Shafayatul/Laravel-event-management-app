<?php

namespace App\Http\Controllers;

use App\Usermeta;
use App\Event;
use App\Booking;
use App\User;
use App\Pass;
use Illuminate\Http\Request;
use Session;
use Auth;

class EventController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
        * Security check
        */
        $current_user_id = Auth::id();
        $current_user = User::find($current_user_id);
        if($current_user['attributes']['is_super_admin'] != 1){
            return "You are not allowed here";
        }

        $events = Event::orderBy('id','DESC')->get();
        return view('event.index')->with(['events'=>$events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        /**
        * Security check
        */
        $current_user_id = Auth::id();
        $current_user = User::find($current_user_id);
        if($current_user['attributes']['is_super_admin'] != 1){
            return "You are not allowed here";
        }

        return view("event.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate request
        $this->validate($request,array(
            'name' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required'
        ));

        // store in database
        $event = new Event;
        $event->name = $request->name;
        $event->start_date = $request->start_date;
        $event->start_time = $request->start_time;
        $event->end_date = $request->end_date;
        $event->end_time = $request->end_time;
        $event->save();
        Session::flash('success','Event successfully added!');
                
        // redirect someone to another page
        return redirect()->route("events.index");
    }

    public function stat($event_id){
        
        $bookings = Booking::where('event_id',$event_id)->get();
        $passes = Pass::where('event_id',$event_id)->get();


        /**
        * booking by admin + booking by delegate type  delegate_type
        */
        $admin_check_in_array = array();
        $delecate_type_array = array();
        $pass_type_array = array();
        foreach ($bookings as $booking) {

            /**
            * booking by admin
            */
            if($booking->is_checked_in==1){
                if (array_key_exists($booking->checked_in_by, $admin_check_in_array)){
                    $admin_check_in_array[$booking->checked_in_by] = $admin_check_in_array[$booking->checked_in_by]+1;
                }else{
                    $admin_check_in_array[$booking->checked_in_by] = 1;
                }                
            }


            /**
            * booking by delegate type
            */
            if($booking->is_checked_in==1){
                if (array_key_exists($booking->delegate_type, $delecate_type_array)){
                    $delecate_type_array[$booking->delegate_type] = $delecate_type_array[$booking->delegate_type]+1;
                }else{
                    $delecate_type_array[$booking->delegate_type] = 1;
                }
            }


            /**
            * booking by pass type
            */
            if (array_key_exists($booking->pass_id, $pass_type_array)){
                $pass_type_array[$booking->pass_id] = $pass_type_array[$booking->pass_id]+1;
            }else{
                $pass_type_array[$booking->pass_id] = 1;
            }

        }


        $admin_check_in_array2 = array();
        foreach ($admin_check_in_array as $key => $value) {
            $dummy_array = array();
            array_push($dummy_array, $key);
            array_push($dummy_array, $value);
            array_push($admin_check_in_array2, $dummy_array);
        }
        $admin_check_in_array2 = json_encode($admin_check_in_array2);

        
        $delecate_type_array2 = array();
        foreach ($delecate_type_array as $key => $value) {
            $dummy_array = array();
            array_push($dummy_array, $key);
            array_push($dummy_array, $value);
            array_push($delecate_type_array2, $dummy_array);
        }
        $delecate_type_array2 = json_encode($delecate_type_array2);


        $pass_type_array2 = array();
        foreach ($pass_type_array as $key => $value) {
            foreach ($passes as $pass) {
                if($pass->id == $key){
                    $dummy_array = array();
                    array_push($dummy_array, $pass->name);
                    array_push($dummy_array, $value);
                    array_push($pass_type_array2, $dummy_array);
                }
            }
        }
        $pass_type_array2 = json_encode($pass_type_array2);


        return view('event.stat',compact('event_id','admin_check_in_array2','delecate_type_array2','pass_type_array2','passes'));
        
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /**
        * Security check
        */
        $current_user_id = Auth::id();
        $current_user = User::find($current_user_id);
        if($current_user['attributes']['is_super_admin'] != 1){
            return "You are not allowed here";
        }
        
        $event = Event::find($id);
        return view('event.edit',compact('event','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // $id = $event->id;
        $this->validate($request,[
            'name' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required'
        ]);



        $event = Event::find($id);
        $event->name = $request->name;
        $event->start_date = $request->start_date;
        $event->start_time = $request->start_time;
        $event->end_date = $request->end_date;
        $event->end_time = $request->end_time;
        $event->save();

        Session::flash('success','Event successfully updated!');
        
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
    * Ajax Delete
    */
    public function ajaxDelete(Request $request) {
        /**
        * Security check
        */
        $current_user_id = Auth::id();
        $current_user = User::find($current_user_id);
        if($current_user['attributes']['is_super_admin'] != 1){
            return "You are not allowed here";
        }

        $id = $request->input('id');
        Event::where('id', $id)->delete();
        return response()->json([ 'data'=> 'success' ]);            
    }

    /**
    * Change Admin
    */
    public function changeAdmin(Request $request) {

        $user_id = $request->input('user_id');
        $event_id = $request->input('event_id');
        $current_status = $request->input('current_status');


        if($current_status == "Active"){
            Usermeta::where('event_id',$event_id)->where('user_id',$user_id)->delete();
        }else{
            $usermeta = new Usermeta;
            $usermeta->user_id = $request->user_id;
            $usermeta->event_id = $request->event_id;
            $usermeta->save();
        }
        return response()->json([ 'data'=> 'success' ]);     
    }

    /**
    * show add admin to event 
    */
    public function asignAdmin($event_id) {

        /**
        * Security check
        */
        $current_user_id = Auth::id();
        $current_user = User::find($current_user_id);
        if($current_user['attributes']['is_super_admin'] != 1){
            return "You are not allowed here";
        }

        $users = User::all();
        $admin_ids = Usermeta::where('event_id', $event_id)->pluck('user_id')->toArray();
        return view('event.asignAdmin', compact('event_id','users','admin_ids'));
    }


}
