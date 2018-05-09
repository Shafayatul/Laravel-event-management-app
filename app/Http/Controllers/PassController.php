<?php

namespace App\Http\Controllers;
use App\Pass;
use App\Event;
use App\Booking;
use Illuminate\Http\Request;
use Session;

class PassController extends Controller
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
    public function index($event_id)
    {
        $passes = Pass::where('event_id', $event_id)->get();
        return view('pass.index',compact('event_id','passes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($event_id)
    {
        return view("pass.create",compact('event_id'));
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
            'event_id' => 'required',
            'name' => 'required',
            'color_name' => 'required',
            'color_code' => 'required',
            'price' => 'required',
        ));

        // store in database
        $pass = new Pass;
        $pass->event_id = $request->event_id;
        $pass->name = $request->name;
        $pass->color_name = $request->color_name;
        $pass->color_code = $request->color_code;
        $pass->price = $request->price;
        $pass->save();
        Session::flash('success','Pass successfully added!');

        return back();
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
        $pass = Pass::find($id);
        return view('pass.edit',compact('pass','id'));
    }
    public function passEdit($id,$event_id)
    {
        $pass = Pass::find($id);
        return view('pass.edit',compact('pass','id','event_id'));
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
        // validate request
        $this->validate($request,array(
            'event_id' => 'required',
            'name' => 'required',
            'color_name' => 'required',
            'color_code' => 'required',
            'price' => 'required',
        ));

        // store in database
        $pass = Pass::find($id);
        $pass->event_id = $request->event_id;
        $pass->name = $request->name;
        $pass->color_name = $request->color_name;
        $pass->color_code = $request->color_code;
        $pass->price = $request->price;
        $pass->save();
        Session::flash('success','Pass successfully updated!');

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
        $id = $request->input('id');
        Pass::where('id', $id)->delete();
        return response()->json([ 'data'=> 'success' ]);            
    }


    /**
    * stat
    */
    public function stat($delegate_id) {
        $events = Event::all();
        $bookings = Booking::where('delegate_id',$delegate_id)->orderBy('id','DESC')->paginate(20);
        $passes = Pass::get();
        return view('pass.stat',compact('events','bookings','passes'));           
    }
    public function passAmount(Request $request) {
        $id = $request->input('id');
        $pass = Pass::where('id', $id)->first();
        return response()->json([ 'data'=> $pass->price ]);          
    }

}
