<?php

namespace App\Http\Controllers\MailBlast\StartMail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use App\Http\Controllers\MailBlast\Proses\ApprovalController;

class UploadController extends Controller
{
    //
    public function index(){
        $product = DB::table("imaging_product")->get();        
        $data = DB::table('mail_master')
            ->join('imaging_product', 'imaging_product.id', '=', 'mail_master.product_id')
            ->select('mail_master.*', 'imaging_product.product_name')
            ->orderBy('mail_master.id', 'ASC')
            ->get();
            \LogActivityUser::addToLog('View List Mail Blast'); 
        
        return view('mailblast.startemail.listdatamailblast')->with(['product' => $product, 'data' => $data]);
    }

    public function upload(Request $request){
        $product_id = $request->product_id;
        //$product = DB::table('imaging_product')->where('id', $product_id)->first();
        $cycle = $request->cycle;
        $part = $request->part;
        $user = Auth::user();
        if($request->hasFile('file')){
            $file=$request->file('file');
    		$fileName = $file->getClientOriginalName();
    		$pathFile = $this->dir_FileUpload.DIRECTORY_SEPARATOR.$fileName;
    		$file->move($this->dir_FileUpload,$fileName);

            $dataList = array();
            $dataList = $this->MailreadText($pathFile);

			if(array_key_exists('error', $dataList)) {
				return response()->json([
					'status'=>0,
					'message'=>$dataList
				]);									
			} 
            
			$master['product_id']=$product_id;            
            $master['cycle']=$cycle;            
            $master['file_name_upload']=$fileName;
            $master['path_file_upload']=$pathFile;
            $master['batch']=$part;
            $master['upload_by']=$user->id;            
            
            $id_master = $this->MailinsertToMasterData($master);

            foreach($dataList as $value){
                $id_detail = $this->MailinsertToDetail($value, $id_master);
                $kirim = new ApprovalController();
                $kirim->approvedLangsung($id_detail);
            }
            \LogActivityUser::addToLog('Upload List Mail Blast');
            return response()->json([
				'status'=>200,
				'message'=>'Success Upload ..'
			]);	            
        }else{
			return response()->json([
				'status'=>0,
				'message'=>'Error File not valid'
			]);	            
        }
    }


    public function detail($id){
        $id_dec = \Crypt::decrypt($id);
        $master = DB::table('mail_master')->where('id',$id_dec)->first();
        $detail = DB::table('mail_detail_data')->where('master_id',$id_dec)->get();
        return view('mailblast.startemail.detail')->with(['detail' => $detail, 'value' => $master]);
    }

    public function delete(Request $r)
    {
        # code...
        $msg ="";
        DB::beginTransaction();
        try
        {
            DB::table('mail_master')->where('id',$r->id)->delete();            
            DB::table('mail_detail_data')->where('master_id',$r->id)->delete();
            DB::table('mail_sending_data')->where('master_id',$r->id)->delete();  
            DB::commit();
            \LogActivityUser::addToLog('Delete List Mail Blast');
            return response()->json([
                    'status' => 200,
                    'message' => 'delete success'
                ]);             
        }catch(Exception $e){
            DB::rollBack();
            $msg = $e;
        }     
        return response()->json([
            'status' => 500,
            'message' => $e
        ]);  
    }
}
