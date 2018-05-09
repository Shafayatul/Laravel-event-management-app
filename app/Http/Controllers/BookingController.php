<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Pass;
use Illuminate\Http\Request;
use Session;

use Auth;
use App\User;
use App\Usermeta;

class BookingController extends Controller
{

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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($event_id, $delegate_id)
    {

    }
    public function add($event_id)
    {   


        /**
        * Security check
        */
        $current_user_id = Auth::id();
        $current_user = User::find($current_user_id);
        if($current_user['attributes']['is_super_admin'] != 1){
            $count = Usermeta::where('event_id',$event_id)->where('user_id',$current_user_id)->count();
            if($count != 1){
                return "You are not allowed here";
            }
        }

        $passes = Pass::where('event_id',$event_id)->orderBy('name')->pluck('name', 'id');
        $passes->prepend('Select', 'Select');
        return view("booking.add",compact('event_id','passes'));
    }    
    /**
    * Show all user
    */
    public function allUserList($event_id)
    {
        $passes = Pass::where('event_id',$event_id)->get();
        $delegates = Booking::where('event_id',$event_id)->get();
        return view("booking.allUserList",compact('delegates','event_id','passes'));
    }






    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //current admin name
        $current_user = User::find(Auth::id());
        $checked_in_by = $current_user['attributes']['name'];


        // validate request
        $this->validate($request,array(
            'delegate_name' => 'required',
            'delegate_email' => 'required',
            'event_id' => 'required',
            'pass_id' => 'required',
        ));

        if($request->is_checked_in == 1 ){
            $is_checked_in = 1;
        }else{
            $is_checked_in = 0;
        }

        // store in database
        for ($i=0; $i < $request->Quantity ; $i++) { 
            $booking = new Booking;
            $booking->delegate_name = $request->delegate_name;
            $booking->delegate_email = $request->delegate_email;
            $booking->delegate_type = $request->delegate_type;        
            $booking->event_id = $request->event_id;
            $booking->pass_id = $request->pass_id;
            $booking->amount_paid = $request->amount_paid;
            $booking->checked_in_by = $checked_in_by;
            $booking->purchase_source = $request->purchase_source;
            $booking->purchase_reference = $request->purchase_reference;
            $booking->hotel = $request->hotel;
            $booking->is_checked_in = $is_checked_in;
            $booking->save();
        }
        // redirect someone to another page
        return redirect('/bookings/bookingList/'.$request->event_id);
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
    public function edit($id,$event_id)
    {

        $booking = Booking::find($id);


        /**
        * Security check
        */
        $current_user_id = Auth::id();
        $current_user = User::find($current_user_id);
        if($current_user['attributes']['is_super_admin'] != 1){
            $count = Usermeta::where('event_id',$event_id)->where('user_id',$current_user_id)->count();
            if($count != 1){
                return "You are not allowed here";
            }
        }

        $passes = Pass::where('event_id',$event_id)->pluck('name', 'id');

        return view('booking.edit',compact('booking','id','event_id','passes'));
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
        //current admin name
        $current_user = User::find(Auth::id());
        $checked_in_by = $current_user['attributes']['name'];


        // validate request
        $this->validate($request,array(
            'delegate_name' => 'required',
            'delegate_email' => 'required',
            'event_id' => 'required',
            'pass_id' => 'required',
        ));

        if($request->is_checked_in == 1 ){
            $is_checked_in = 1;
        }else{
            $is_checked_in = 0;
        }

        // store in database
        $booking = Booking::find($id);
        $booking->delegate_name = $request->delegate_name;
        $booking->delegate_email = $request->delegate_email;
        $booking->delegate_type = $request->delegate_type;        
        $booking->event_id = $request->event_id;
        $booking->pass_id = $request->pass_id;
        $booking->amount_paid = $request->amount_paid;
        $booking->checked_in_by = $checked_in_by;
        $booking->purchase_source = $request->purchase_source;
        $booking->purchase_reference = $request->purchase_reference;
        $booking->hotel = $request->hotel;
        $booking->is_checked_in = $is_checked_in;
        $booking->save();
        // redirect someone to another page
        return redirect('/bookings/bookingList/'.$request->event_id);
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
     *  Booking List
     */
    public function bookingList($event_id)
    {

        /**
        * Security check
        */
        $current_user_id = Auth::id();
        $current_user = User::find($current_user_id);
        if($current_user['attributes']['is_super_admin'] != 1){
            $count = Usermeta::where('event_id',$event_id)->where('user_id',$current_user_id)->count();
            if($count != 1){
                return "You are not allowed here";
            }
        }


        $passes = Pass::where('event_id',$event_id)->get();
        $bookings = Booking::orderBy('id','DESC')->where('event_id',$event_id)->get();
        $total_delegates = count($bookings);
        $delegates_sign_in = Booking::where('event_id',$event_id)->where('is_checked_in',1)->count();
        $pending_delegates = $total_delegates-$delegates_sign_in;
        return view("booking.bookingList",compact('bookings','passes','event_id','total_delegates','delegates_sign_in','pending_delegates'));
    }

    public function history($event_id)
    {
        /*for stat*/
        
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

        /*stat ends*/




        /**
        * Security check
        */
        $current_user_id = Auth::id();
        $current_user = User::find($current_user_id);
        if($current_user['attributes']['is_super_admin'] != 1){
            $count = Usermeta::where('event_id',$event_id)->where('user_id',$current_user_id)->count();
            if($count != 1){
                return "You are not allowed here";
            }
        }
        
        $passes = Pass::where('event_id',$event_id)->get();
        $bookings = Booking::orderBy('id','DESC')->where('event_id',$event_id)->get();
        return view("booking.history",compact('admin_check_in_array2','delecate_type_array2','pass_type_array2','bookings','passes','event_id'));
    }


    /**
     *  Check in list
     */
    public function checkedInList($event_id)
    {
        $passes = Pass::all();
        $delegates = Booking::where('event_id',$event_id)->get();
        $bookings = Booking::where('is_checked_in',1)->where('event_id',$event_id)->paginate(20);
        return view("booking.bookingList",compact('delegates','bookings','passes'));
    }
    /**
    * checked In
    */
    public function checkedIn(Request $request) {

        //current admin name
        $current_user = User::find(Auth::id());
        $checked_in_by = $current_user['attributes']['name'];

        $id = $request->input('id');
        $booking = Booking::find($id);
        $booking->is_checked_in = 1;
        $booking->checked_in_by = $checked_in_by;
        $booking->save();
        return response()->json([ 'data'=> 'success' ]);            
    }


    /**
    * checked In
    */
    public function checkOut(Request $request) {

        //current admin name
        $current_user = User::find(Auth::id());
        $checked_in_by = $current_user['attributes']['name'];

        $id = $request->input('id');
        $booking = Booking::find($id);
        $booking->is_checked_in = 0;
        $booking->checked_in_by = $checked_in_by;
        $booking->save();
        return response()->json([ 'data'=> 'success' ]);            
    }




}
