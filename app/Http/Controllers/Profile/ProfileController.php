<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Validator;

class ProfileController extends Controller
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
    //
    public function index(Request $r)
    {
        # code...
        $data = DB::table('users')->where('id',Auth::user()->id)->first();
        \LogActivityUser::addToLog('View Menu Change Password');
        return view('profile.changepass')->with('data',$data);
    }

    public function changepassword(Request $r)
    {
        # code...
        $old_password = $r->old_password;
        $new_password = $r->new_password;
        $confirm_password = $r->confirm_password;

        $check = DB::table('users')->where('id',Auth::user()->id)->first();
        if(Hash::make($old_password) == $check->password){
            return response()->json([
                'data' => 'Sukses'
            ],200);
        }else{
            return response()->json([
                'data' => 'Gagal'
            ],403);
        }
    }

    public function check_old_pass(Request $r)
    {
        # code...
        $old_password = $r->old_password;
        
        if((Hash::check($old_password, Auth::user()->password))){
            return response()->json([
                'data' => 'Password Matched'                
            ],200);
        }else{
            return response()->json([
                'data' => 'Password Not Matched'
            ],404);
        }
    }

    public function check_new_pass(Request $r)
    {
        # code...
        $new_password = $r->new_password;
        if(!(Hash::check($new_password, Auth::user()->password))){
            return response()->json([
                'data' => 'Password Matched'                
            ],200);
        }else{
            return response()->json([
                'data' => 'Password Not Same with Old'
            ],404);
        }
    }

    public function save_form_c_pass(Request $r)
    {
        # code...
        $password = $r->new_password;
        try{
            $user = Auth::user();
            $user->password = bcrypt($password);
            $user->save();
            \LogActivityUser::addToLog('Success Change Password');
            return response()->json([
                'data' => 'Success Change Password'                
            ],200);            
        }catch(Exception $e){
            \LogActivityUser::addToLog('Fail Change Password');
            return response()->json([
                'data' => 'Failed Change Password'
            ],404);
        }        
    }
}
