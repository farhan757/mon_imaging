<?php

namespace App\Http\Controllers\MailBlast\Proses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class ApprovalController extends Controller
{
    //
    public function index(){
        $auth = Auth::user();
        $data = DB::table('mail_detail_data');
        $data->join('mail_master','mail_master.id','=','mail_detail_data.master_id');
        $data->leftJoin('users','users.id','=','mail_master.user_id');
        $data->select('mail_detail_data.*');
                if($auth->customer_id > 0){
                    $data = $data->where('users.customer_id','=',$auth->customer_id);
                }
                
                $data = $data->where('app',0)->get();
        $view = view('Proses.Approval.listapproval');
        $view->with('data',$data);
        return $view;
    }

    public function downloadPdf($id)
    {
        # code...
        $getData = DB::table('detail_data')->where('id',$id)->first();
        return response()->download($getData->attachment);
    }

    public function approvedWithid(Request $request)
    {
        $error = ""; $body_mail_final = "";
        # code...
        $getData = DB::table('detail_data')->where('id',$request->id)->first();
        $getContentEmail = DB::table('master_data')
                    ->join('project','project.id','=','master_data.project_id')
                    ->leftJoin('body_email','project.body_mail_id','=','body_email.id')
                    ->where('master_data.id','=',$getData->master_id)->first();

        $getBuildContentMail = $this->MailbuildMail($getData,$getContentEmail);
        
        DB::beginTransaction();
        try{
            $idSending = DB::table('mail_sending_data')->insertGetId([
                'master_id' => $getData->master_id,
                'account' => $getData->account,
                'no_spaj' => $getData->no_spaj,
                'name' => $getData->name,
                'to' => $getData->to,
                'cc' => $getData->cc,
                'bcc' => $getData->bcc,
                'subject_mail' => $getBuildContentMail['subject'],
                'body_mail_base' => $getBuildContentMail['bodymail'],
                'attachment' => $getData->attachment,
                'password_attach' => $getData->password_attach,
                'user_id' => Auth::id(),
                'flaging' => $getData->flaging,
                'id_mail' => $getData->id_mail,
                'tgl_terbit' => $getData->tgl_terbit,
                'created_at' => Carbon::now()
            ]);
            DB::table('mail_detail_data')->where('id',$request->id)->update([
                'app' => 1
            ]);
            
            $body_mail_final = $this->MailbuildCodeVerifymail($idSending,$getBuildContentMail['bodymail']);

            DB::table('mail_sending_data')->where('id',$idSending)->update([
                'body_mail' => $body_mail_final
            ]);

            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Approved Success'
            ]);
        }catch(Exception $e){
            DB::rollBack(); 
            $error = $e;          
        }
        return response()->json([
            'status' => 500,
            'message' => $error
        ]);         
    }

    public function NoapprovedWithid($id)
    {
        $error = ""; $body_mail_final = "";
        # code...
        $getData = DB::table('mail_detail_data')->where('id',$id)->first();
        $getContentEmail = DB::table('mail_master')
                    ->join('project','project.id','=','master_data.project_id')
                    ->leftJoin('body_email','project.body_mail_id','=','body_email.id')
                    ->where('master_data.id','=',$getData->master_id)->first();

        $getBuildContentMail = $this->buildMail($getData,$getContentEmail);
        
        DB::beginTransaction();
        try{
            $idSending = DB::table('notsent_data')->insertGetId([
                'master_id' => $getData->master_id,
                'account' => $getData->account,
                'no_spaj' => $getData->no_spaj,
                'name' => $getData->name,
                'to' => $getData->to,
                'cc' => $getData->cc,
                'bcc' => $getData->bcc,
                'subject_mail' => $getContentEmail->subject,
                'body_mail_base' => $getContentEmail->body_mail,
                'attachment' => $getData->attachment,
                'password_attach' => $getData->password_attach,
                'user_id' => Auth::id(),
                'flaging' => $getData->flaging,
                'id_mail' => $getData->id_mail,
                'tgl_terbit' => $getData->tgl_terbit,
                'created_at' => Carbon::now()
            ]);
            DB::table('detail_data')->where('id',$id)->update([
                'app' => 2
            ]);
            
            $body_mail_final = $this->buildCodeVerifymail($idSending,$getBuildContentMail['bodymail']);

            DB::table('notsent_data')->where('id',$idSending)->update([
                'body_mail' => $body_mail_final
            ]);

            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'NoApproved Success'
            ]);
        }catch(Exception $e){
            DB::rollBack(); 
            $error = $e;          
        }
        return response()->json([
            'status' => 500,
            'message' => $error
        ]);         
    } 
    
    public function approvedLangsung($id)
    {
        $error = ""; $body_mail_final = "";
        # code...
        $getData = DB::table('mail_detail_data')->where('id',$id)->first();
        $getContentEmail = DB::table('mail_detail_data')                    
                    ->leftJoin('mail_body_email','mail_detail_data.flaging','=','mail_body_email.id')
                    ->where('mail_detail_data.id','=',$getData->id)->first();

        $getBuildContentMail = $this->MailbuildMail($getData,$getContentEmail);
        
        DB::beginTransaction();
        try{
            $idSending = DB::table('mail_sending_data')->insertGetId([
                'master_id' => $getData->master_id,
                'account' => $getData->account,
                'no_spaj' => $getData->no_spaj,
                'name' => $getData->name,
                'to' => $getData->to,
                'cc' => $getData->cc,
                'bcc' => $getData->bcc,
                'subject_mail' => $getBuildContentMail['subject'],
                'body_mail_base' => $getBuildContentMail['bodymail'],
                'attachment' => $getData->attachment,
                'password_attach' => $getData->password_attach,
                'user_id' => Auth::id(),
                'flaging' => $getData->flaging, //bodyemail
                'id_mail' => $getData->id_mail,
                'tgl_terbit' => $getData->tgl_terbit,
                'created_at' => Carbon::now()
            ]);
            DB::table('mail_detail_data')->where('id',$id)->update([
                'app' => 1
            ]);
            
            $body_mail_final = $this->MailbuildCodeVerifymail($idSending,$getBuildContentMail['bodymail']);

            DB::table('mail_sending_data')->where('id',$idSending)->update([
                'body_mail' => $body_mail_final
            ]);

            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Approved Success'
            ]);
        }catch(Exception $e){
            DB::rollBack(); 
            $error = $e;          
        }
        return response()->json([
            'status' => 500,
            'message' => $error
        ]);         
    }    
}
