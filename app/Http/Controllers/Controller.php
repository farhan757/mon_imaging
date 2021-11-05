<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $uploadTemp = "/var/www/filelistimaging";
    public $pathPdf = "/home/sftp-PDFimaging/Upload";    
    public $dir_FileUpload = "/var/www/filemailblast";
    
    function readExel($file_name)
    {
        $error = array();
        $error['error'] = "Error dibaris berikut :";
        $error['row'] = array();
        $return = array();

        $spreadsheet = IOFactory::load($file_name);
        $objWorksheet = $spreadsheet->getActiveSheet();
        //$sheetData = $spreadsheet->getSheet(0)->toArray(null, true, true, true);
        //      var_dump($sheetData);
        //        $sheetData = $spreadsheet->getSheet(0)->toArray(null, true, true, true);
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();

        $temp = array();
        if ($highestRow > 1) {

            for ($row = 2; $row <= $highestRow; ++$row) {
                $err = 0;
                $tmpret = array();
                $tmpret['no_account'] =  $objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
                $tmpret['name_account'] =  $objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
                $tmpret['address_account'] =  $objWorksheet->getCellByColumnAndRow(3, $row)->getValue();
                $tmpret['number_of_pages'] =  $objWorksheet->getCellByColumnAndRow(4, $row)->getValue();
                $tmpret['no_box'] =  $objWorksheet->getCellByColumnAndRow(5, $row)->getValue();
                $tmpret['no_manifest'] =  $objWorksheet->getCellByColumnAndRow(6, $row)->getValue();
                $tmpret['no_doc'] =  $objWorksheet->getCellByColumnAndRow(7, $row)->getValue();
                $tmpret['file_name'] =  $objWorksheet->getCellByColumnAndRow(8, $row)->getValue();                              
                $tmpret['no_spaj'] = $objWorksheet->getCellByColumnAndRow(9, $row)->getValue();  
                $tmpret['tgl_scan'] = $objWorksheet->getCellByColumnAndRow(10, $row)->getValue();  
                $tmpret['password_pdf'] = $objWorksheet->getCellByColumnAndRow(11, $row)->getValue();  
                if ($err == 1) {
                    array_push($error['row'], $row);
                } else {
                    array_push($return, $tmpret);
                }
            }
        }
        if (count($error['row']) > 2) {
            return $error;
        } else return $return;
    }

    function readText($file_name, $delimited = '|')
    {
        $error = array();
        $error['error'] = "Error :";
        $return = array();
        $file = fopen($file_name, 'r');
        $cntf = 0;
        while (!feof($file)) {
            $err = 0;
            $cntf++;
            $text = fgets($file);
            if ($cntf > 1 && $text != "") {
                $index = $cntf - 1;
                $texts = explode($delimited, $text);
                $tmpret = array();
                $tmpret['no_account'] = $texts[0];
                $tmpret['name_account'] = $texts[1];
                $tmpret['address_account'] = $texts[2];
                $tmpret['number_of_pages'] = $texts[3];
                $tmpret['no_box'] = $texts[4];
                $tmpret['no_manifest'] = $texts[5];
                $tmpret['no_doc'] = $texts[6];
                $tmpret['file_name'] = $texts[7];
                $tmpret['no_spaj'] = $texts[8];
                $tmpret['tgl_scan'] = $texts[9]; // yyyy-mm-dd
                $tmpret['password_pdf'] = $texts[10];
                $tmpret['id_kriteria'] = $texts[11];
                if ($err == 1) {
                    array_push($error, $text);
                } else {
                    array_push($return, $tmpret);
                }
            }
        }
        fclose($file);

        if (count($error) > 2) {
            return $error;
        } else
            return $return;
    }
    
    function insertToDetail($data, $id_prod)
    {
        DB::beginTransaction();
        try {
            $tmp_id = DB::table('imaging_master_detail')
                ->insertGetId([
                    'id_master' => $id_prod,
                    'no_account' => $data['no_account'],
                    'name_account' => $data['name_account'],
                    'address_account' => $data['address_account'],
                    'number_of_pages' => $data['number_of_pages'],
                    'no_box' => $data['no_box'],
                    'no_manifest' => $data['no_manifest'],
                    'no_doc' => $data['no_doc'],
                    'file_name' => trim($data['file_name']),
                    'path_file' => trim($data['path_file']),
                    'current_pos' => $data['current_pos'],
                    'no_spaj' => $data['no_spaj'],
                    'tgl_scan' => $data['tgl_scan'],
                    'password_pdf' => $data['password_pdf'],
                    'id_kriteria' => $data['id_kriteria'],
                    'created_at' => Carbon::now()                    
                ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $tmp_id = $e;
        }
        return $tmp_id;
    }  
    
    function insertToMaster($data)
    {
        DB::beginTransaction();
        try {
            $id = DB::table('imaging_master')
                ->insertGetId([
                    'product_id' => $data['product_id'],
                    'cycle' => $data['cycle'],
                    'file_name_upload' => $data['file_name_upload'],
                    'path_file_upload' => $data['path_file_upload'],
                    'upload_by' => $data['upload_by'],
                    'created_at' => Carbon::now()
                ]);  
                DB::commit();
                return $id;        
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    } 
    
    function no_bast()
    {
        # code...
        $rnd = rand(0,999999);
        $ada = DB::table('imaging_bast')->where('no_bast',$rnd)->exists();
        if($ada){
            return $this->no_bast();
        }else{
            return $rnd;
        }
    }

    // funtion untuk mail blast
    function MailreadText($file_name, $delimited='|') {
        $error = array();
        $error['error']="Error :";
        $return = array();
        $file = fopen($file_name, 'r');
        $cntf=0;
        while (!feof($file)) {
            $err = 0;
            $cntf++;
            $text = fgets($file);
            if($cntf>1 && $text!="") {
                $index = $cntf-1;
                $texts = explode($delimited, $text);
                $tmpret = array();
                $tmpret['account'] = $texts[0];
                $tmpret['no_spaj'] = $texts[1];
                $tmpret['name'] = $texts[2];
                $tmpret['to'] = $texts[3];
                $tmpret['cc'] = $texts[4];
                $tmpret['bcc'] = $texts[5];
                $tmpret['attachment'] = $texts[6];
                $tmpret['password_attach'] = $texts[7];
                $tmpret['flaging'] = $texts[8];
                $tmpret['id_mail'] = trim($texts[9]);
                $tmpret['tgl_terbit'] = trim($texts[10]);

                if($err==1) {
                    array_push($error, $text);
                } else {
                    array_push($return, $tmpret);
                }
            }
        }
        fclose($file);

        if(count($error)>2) {
            return $error;
        } else
        return $return;
    }   
    
    function MailinsertToMasterData($data) {
        DB::beginTransaction();
        try{
            $id = DB::table('mail_master')            
            ->insertGetId([                
                'product_id'=>$data['product_id'],
                'batch'=>$data['batch'],
                'cycle'=>$data['cycle'],                
                'file_name_upload'=>$data['file_name_upload'],
                'path_file_upload'=>$data['path_file_upload'],                
                'upload_by'=>$data['upload_by'],
                'created_at'=>Carbon::now()
            ]);
            DB::commit();
            return $id;
        }catch(Exception $e){
            DB::rollBack();
            return $e;
        }
    }  
    
    function MailinsertToDetail($data, $id_prod) {
        DB::beginTransaction();
        try{
            $tmp_id = DB::table('mail_detail_data')
            ->insertGetId([
                'master_id'=>$id_prod,
                'account'=>$data['account'],
                'no_spaj' => $data['no_spaj'],
                'name'=>$data['name'],
                'to'=>$data['to'],
                'cc'=>$data['cc'],
                'bcc'=>$data['bcc'],
                'attachment'=>$data['attachment'],
                'password_attach'=>$data['password_attach'],
                'flaging' => $data['flaging'],
                'id_mail' => $data['id_mail'],
                'tgl_terbit' => $data['tgl_terbit'],
                'created_at'=>Carbon::now()
            ]);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack(); 
            $tmp_id = $e;           
        }
        return $tmp_id;
    }    

    function MailgetCodeVerify($id){
        DB::beginTransaction();
        try{
            $code = Str::random(32);
            DB::table('mail_tmp_verify_read')->insert([
                'code_verify' => $code,
                'sending_id' => $id,
                'created_at' => Carbon::now()
            ]);
            DB::commit();
            return $code;
        }catch(Exception $e){
            DB::rollBack();
            $this->getCodeVerify($id);
        }
    }

    public function MailgetCounter($code) {
    	$tmp = DB::table('mail_table_counter')
    	->where('keys','=',$code)
    	->select('counter')
    	->first();
    	if($tmp) {
	    	$counter = $tmp->counter+1;
	    	DB::table('mail_table_counter')
	    	->where('keys','=',$code)
	    	->update([
	    		'counter'=>$counter
	    	]);
    	} else {
    		$counter=1;
    		DB::table('mail_table_counter')
    		->insert([
    			'keys'=>$code,
    			'counter'=>$counter
    		]);
    	}

    	return $counter;
    }

    function Mailgencode(){
        $counter = str_pad($this->getCounter('mail_gen_code') ,5,'0',STR_PAD_LEFT);

        return 'SET-'.$counter;        
    }    
    
    function MailbuildCodeVerifymail($id,$contentmail)
    {
        # code...
        $code = $this->MailgetCodeVerify($id);
        $read_flag = str_replace('#READ FLAG#',$code,$contentmail);
        return $read_flag;
    }

    function MailbuildMail($data,$contentmail){
        $url = url('').'/api/verify/#READ FLAG#';
        $tmp = '<!doctype html>
                    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"> 
                    <head> 
                    <title>
                            Notification
                          </title> <!--[if !mso]><!-- --> 
                        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--<![endif]--> 
                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
                        <meta name="viewport" content="width=device-width, initial-scale=1"> 

                        <style type="text/css">
                        #outlook a { padding:0; }
                        .ReadMsgBody { width:100%; }
                        .ExternalClass { width:100%; }
                        .ExternalClass * { line-height:100%; }                        
                        img { border:0;height:auto;line-height:100%; outline:none;text-decoration:none;-ms-interpolation-mode:bicubic; }
                        
                      </style>  
                <style type="text/css">
                        @media only screen and (max-width:480px) {
                          @-ms-viewport { width:320px; }
                          @viewport { width:320px; }
                        }
                      </style> 
                        

                        <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" type="text/css"> 
                        <style type="text/css">
                                @import url(https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700);
                            </style> 
                        

                        <meta charset="UTF-8"> 
                        <meta name="description" content="Notification"> 
                        <meta property="og:type" content="website"> 
                        <meta property="og:locale" content="en_us"> 
                        <meta property="og:url" content="'.$url.'"> 
                        <meta property="og:title" content="Notification"> 
                        <meta property="og:description" content="Notification"> 
                        <meta property="og:image" itemprop="image" content="'.$url.'"> 
                        <meta property="og:image:type" content="image/png"> 
                        <meta property="og:site_name" content="'.$url.'"> 
                        <meta name="twitter:card" content="summary_large_image"> 
                        <meta name="twitter:site" content="'.$url.'"> 
                        <meta name="twitter:title" content="Notification"> 
                        <meta name="twitter:description" content="Notification"> 
                        <meta name="twitter:image" content="'.$url.'"> 
                        </head>                        
                        <body>                            
                            #BODYMAIL#';

        $array = json_decode(json_encode($data), true);
        $settingan = DB::table('mail_variable_detail')->where('master_vid',$contentmail->mv_id)->get();

        $subject = $contentmail->subject;

        foreach($settingan as $value){
            $subject = str_replace($value->nm_variable,$array[$value->nm_field],$subject);
        }

        $bodymail = $contentmail->body_mail;
        foreach($settingan as $value){
            $bodymail = str_replace($value->nm_variable,$array[$value->nm_field],$bodymail);
        }

        $bodymail = str_replace("#BODYMAIL#",$bodymail,$tmp);

        
        //$url = 'http://192.168.12.47:8081/mon_imaging/public/api/verify/#READ FLAG#';
        $content = '</br><p><img src="'.$url.'" width="1" height="1" style="display:none!important;height:auto;width:100%;" /></p>';

        $bodymail = $bodymail.''.$content;

        $bodymail .= '  </body>
                      </html>';

        $arr = array(
            'subject' => $subject,
            'bodymail' => $bodymail
            );

        return $arr;
    }

    public function Mailgetset(Request $request)
    {
        # code...
        $data = DB::table('mail_variable_detail')->where('master_vid',$request->input('id'))->get();
        return response()->json([
            'data' => $data
        ]);
    }

    public function getCounter($code) {
    	$tmp = DB::table('mail_table_counter')
    	->where('keys','=',$code)
    	->select('counter')
    	->first();
    	if($tmp) {
	    	$counter = $tmp->counter+1;
	    	DB::table('mail_table_counter')
	    	->where('keys','=',$code)
	    	->update([
	    		'counter'=>$counter
	    	]);
    	} else {
    		$counter=1;
    		DB::table('mail_table_counter')
    		->insert([
    			'keys'=>$code,
    			'counter'=>$counter
    		]);
    	}

    	return $counter;
    }
}
