<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Session;
use Hash;
use Auth;


class UserController extends Controller{

    public function index(){

        /**
        * Security check
        */
        $current_user_id = Auth::id();
        $current_user = User::find($current_user_id);
        if($current_user['attributes']['is_super_admin'] != 1){
            return "You are not allowed here";
        }
        
        $users = User::orderBy('id','ASC')->paginate(20);
        return view('user.index')->with(['users'=>$users]); 
    }

    public function changeStatus(Request $request) {

        /**
        * Security check
        */
        $current_user_id = Auth::id();
        $current_user = User::find($current_user_id);
        if($current_user['attributes']['is_super_admin'] != 1){
            return "You are not allowed here";
        }


        $id = $request->input('id');
        $currentType = $request->input('currentType');

        if($id==1){
        	return response()->json([ 'data'=> 'This user can not be Changed.' ]);
        }else{

        	if($currentType==1){
        		$next = 0;
        	}else{
        		$next = 1;
        	}

			$User = User::find($id);
			$User->is_super_admin = $next;
			$User->save();

	        return response()->json([ 'data'=> 'success' ]);        	
        }
    }



    public function changePassword(Request $request){
 
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
 
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
 
        $this->validate($request, [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
 
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
 
        return redirect()->back()->with("success","Password changed successfully !");
 
    }


    public function resetPassword() {
        return view("user.resetPassword");
    }

    public function ajaxDelete(Request $request) {
        $id = $request->input('id');
        if($id==1){
        	return response()->json([ 'data'=> 'This user can not be deleted.' ]);
        }else{
	        User::where('id', $id)->delete();
	        return response()->json([ 'data'=> 'success' ]);        	
        }
    }

}
