<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class PDFNSBController extends Controller
{
    //
    public function viewpdf($cycle,$nopol,$nmfile, $cekfile = "",$depart="", $max = 100)
    {
        # code...
        $userInfo = Auth::user();
        $host = request()->getHttpHost();
        $pdf = DB::table('imaging_master')
               ->join('imaging_master_detail','imaging_master_detail.id_master','=','imaging_master.id')
               ->join('imaging_product','imaging_product.id','=','imaging_master.product_id')
               ->select('imaging_master_detail.*','imaging_product.product_name')
                ->where('imaging_master.cycle','=',''.$cycle.'')->where('imaging_master_detail.no_account','=',''.$nopol.'')->where('imaging_master_detail.file_name','=',''.$nmfile.'')->first();    
               $file = "";
        
        if($pdf != null){
            if ($host == "imaging.xptlp.co.id") {
                $sc = $this->pathPdf . $pdf->path_file .'/'. $pdf->no_account . '/' . $nmfile;
                $file = "/home/server01/PDF_ENC/ENC-$nmfile";
                if ($cekfile === "") {
                    DB::table('imaging_tmp_pdf_enc')->insert([
                        'path_source' => $sc,
                        'path_dest' => $file,
                        'status' => 0,
                        'kriteria' => $pdf->product_name,
                        'password_pdf' => trim($pdf->password_pdf)
                    ]);
                }            
            }
    
            if (file_exists($file)) {            
                ignore_user_abort(true);
                set_time_limit(0); 
                $path = $file; 
                $fullPath = $path;
                 
                if ($fd = fopen($fullPath, "r")) {
                    $fsize = filesize($fullPath);
                    $path_parts = pathinfo($fullPath);
                    $ext = strtolower($path_parts["extension"]);
                    switch ($ext) {
                        case "pdf":
                            header("Content-type: application/pdf");
                            break;
                        default;
                            header("Content-type: application/octet-stream");
                            header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
                        break;
                    }
                    header("Content-length: $fsize");
                    header("Cache-control: private"); 
                    while(!feof($fd)) {
                        $buffer = fread($fd, 2048);
                        echo $buffer;
                    }
                }
                fclose ($fd);
                if($host == "imaging.xptlp.co.id")
                    unlink($file);                        
                exit;            
            } else { 
                sleep(1);           
                if ($max > 0) {
                    $max = $max - 1; $cekfile = "cekfile";
                    return $this->viewpdf($cycle,$nopol, $nmfile, $cekfile,$depart, $max);
                } else {
                    return "<h5>File Not Found.. please refresh page ..<br>or Please Contact Admin..</h5>";
                }
            }                    
        }else{
            return "<h5>Data Not Found.. <br>or Please Contact Admin..</h5>";
        }
    }

    public function renderView($cycle,$nopol,$nmfile)
    {
        return view('viewpdf')->with('cycle', $cycle)->with('nopol',$nopol)->with('nmfile', $nmfile);
    }
}
