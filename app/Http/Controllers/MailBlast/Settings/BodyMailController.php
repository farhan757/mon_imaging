<?php

namespace App\Http\Controllers\MailBlast\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class BodyMailController extends Controller
{
    //
    public function index()
    {
        # code...
        $auth = Auth::user();
        $data = DB::table('mail_body_email');
        $data = $data->select('users.name as username','mail_body_email.*');
        $data = $data->leftJoin('users','users.id','=','mail_body_email.user_id');
                         
        $data = $data->get();
        
        return view('mailblast.settings.bodyemail.listbodymail')->with('data',$data);
    }

    public function save(Request $request)
    {
        # code...
        $content = $request->konten;
        DB::table('mail_body_email')->insert([
            'mv_id' => $request->setting,
            'desc' => $request->desc,
            'body_mail' => $content, 
            'subject' => $request->subject,
            'user_id' => Auth::id(),
            'created_at' => Carbon::now()
        ]);

        /*return response()->json([
            'status' => 1,
            'message' => 'berhasil'
        ]);*/
        return redirect()->back();
    }

    public function showid($id)
    {
        # code...
        $auth = Auth::user();
        $data = DB::table('mail_body_email')->where('id',$id)->first();
        $mvid = DB::table('mail_master_variable');
        $mvid = $mvid->select('mail_master_variable.*');
        $mvid = $mvid->leftJoin('users','users.id','=','mail_master_variable.user_id');
  
        $mvid = $mvid->get();
        return view('mailblast.settings.bodyemail.formbodymail')->with('data',$data)->with('setting',$mvid);
    }

    public function show()
    {
        # code... 
        $auth = Auth::user(); 
        $mvid = DB::table('mail_master_variable');  
        $mvid = $mvid->select('mail_master_variable.*');
        $mvid = $mvid->leftJoin('users','users.id','=','mail_master_variable.user_id');           
                
        $mvid = $mvid->get();    
        return view('mailblast.settings.bodyemail.formbodymail')->with('setting',$mvid);
    }    

    public function update(Request $request)
    {
        # code...
        DB::table('mail_body_email')->where('id',$request->id)->update([
            'mv_id' => $request->setting,
            'desc' => $request->desc,
            'body_mail' => $request->konten,
            'subject' => $request->subject,
            'user_id' => Auth::id(),
            'updated_at' => Carbon::now()
        ]);
        //$data = DB::table('body_email')->where('id',$request->id)->first();

        return redirect()->back();       
    }

    public function delete(Request $request)
    {
        # code...
        DB::table('mail_body_email')->where('id',$request->id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Delete success'
        ]);
    }
}
