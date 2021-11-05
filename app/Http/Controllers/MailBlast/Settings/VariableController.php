<?php

namespace App\Http\Controllers\MailBlast\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class VariableController extends Controller
{
    //
    public function index()
    {
        # code...
        $auth = Auth::user();
        $data = DB::table('mail_master_variable');
        $data = $data->select('mail_master_variable.*', 'users.name as user_name');
        $data = $data->leftJoin('users','users.id','=','mail_master_variable.user_id');        
        $data = $data->orderBy('id','DESC')->get();

        $view = view('mailblast.settings.variablefield.listvariablefield');        
        $view->with('data',$data);
        return $view;
    }

    public function newForm()
    {
        # code...
        $field = DB::getSchemaBuilder()->getColumnListing('mail_detail_data');
        $view = view('mailblast.settings.variablefield.form');
        $view->with('field',$field);
        return $view;
    }

    public function delete(Request $r)
    {
        # code...
        DB::beginTransaction();
        try{
            DB::table('mail_master_variable')->where('id','=',$r->id)->delete();
            DB::table('mail_variable_detail')->where('master_vid','=',$r->id)->delete();
            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Success..'
            ]);
        }catch(Exception $e){
            DB::rollBack();

            return response()->json([
                'status' => 500,
                'message' => 'Failed..'.$e
            ]);
        }
    }

    public function addform(Request $r)
    {
        # code...
        $field = DB::getSchemaBuilder()->getColumnListing('mail_detail_data');
        return view('mailblast.settings.variablefield.data_form')->with('no', $r->input('id'))->with('field',$field);
    }

    public function addmastervariable(Request $r)
    {
        # code...
        $code = ''; 
        DB::beginTransaction();
        try { 
            $code = $this->Mailgencode();
            DB::table('mail_master_variable')->insert([
                'id' => $code,
                'name' => $r->name,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now()
            ]);
            for ($i = 0; $i < count($r->nm_variable); $i++) {
                DB::table('mail_variable_detail')->insert([
                    'master_vid' => $code,
                    'nm_variable' => $r->nm_variable[$i],
                    'nm_field' => $r->nm_field[$i]
                ]);
            }
            DB::commit();
            echo 'Berhasil ..';
            sleep(5);            
            
        } catch (Exception $e) {
            DB::rollBack();            
        }
        return redirect()->back();
    }

    public function savemastervariable(Request $r)
    {
        # code...
        $code = $r->id; 
        DB::beginTransaction();
        try {             
            DB::table('mail_variable_detail')->where('master_vid','=',$code)->delete();
            for ($i = 0; $i < count($r->nm_variable); $i++) {
                DB::table('mail_variable_detail')->insert([
                    'master_vid' => $code,
                    'nm_variable' => $r->nm_variable[$i],
                    'nm_field' => $r->nm_field[$i]
                ]);
            }
            DB::commit();
            echo 'Berhasil ..';
            sleep(5);            
            
        } catch (Exception $e) {
            DB::rollBack();            
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        # code...
        $data = DB::table('mail_master_variable')->where('id','=',$id)->first();
        $detail = DB::table('mail_variable_detail')->where('master_vid','=',$id)->get();
        $field = DB::getSchemaBuilder()->getColumnListing('mail_detail_data');
        $view = view('mailblast.settings.variablefield.form');
        $view->with('field',$field);
        $view->with('data',$data);
        $view->with('detail',$detail);
        return $view;
    }
}
