<?php

namespace App\Http\Controllers\Imaging;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Storage;
use LogActivityUser;
class UploadController extends Controller
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
    public function index()
    {
        # code...
        $product = DB::table("imaging_product")->get();
        $pos = DB::table('imaging_pos')->get();
        $data = DB::table('imaging_master')
            ->join('imaging_product', 'imaging_product.id', '=', 'imaging_master.product_id')
            ->select('imaging_master.*', 'imaging_product.product_name')
            ->orderBy('imaging_master.id', 'ASC')
            ->get();
            LogActivityUser::addToLog('View List Upload');            
        return view('imaging.listdataimaging')->with(['product' => $product, 'data' => $data, 'pos' => $pos]);
    }

    public function detail(Request $r)
    {
        # code...
        $id = \Crypt::decrypt($r->id);
        $master = DB::table('imaging_master')->where('id', '=', $id)->first();
        $detail = DB::table('imaging_master_detail')->where('imaging_master_detail.id_master', '=', $id)
            ->groupBy('imaging_master_detail.no_account')->get();
            \LogActivityUser::addToLog('Detail UploadController Id : '.$id);    
        return view('imaging.detail')->with(['detail' => $detail, 'value' => $master]);
    }

    public function delete(Request $r)
    {
        # code...
        $id = \Crypt::decrypt($r->id);
         
        DB::beginTransaction();
        try {
            DB::table('imaging_master')->where('id', '=', $id)->delete();
            DB::table('imaging_master_detail')->where('id_master', '=', $id)->delete();
            DB::commit();
            \LogActivityUser::addToLog('Sukses Delete UploadController Id : '.$id);
            return response()->json([
                'status' => 200,
                'message' => "Success",
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            \LogActivityUser::addToLog('Gagal Delete UploadController Id : '.$id.' Log: '.$e);
            return response()->json([
                'status' => 500,
                'message' => "Failed",
            ]);
        }
    }

    public function uploadlist(Request $r)
    {
        # code...
        $product_id = $r->product_id;
        $product = DB::table('imaging_product')->where('id', $product_id)->first();
        $cycle = $r->cycle;
        $pos_id = $r->pos_id;
        if ($r->hasFile('file')) {
            $user = Auth::user();
            $file = $r->file('file');
            $fileName = $file->getClientOriginalName();
            $pathFile = $this->uploadTemp . DIRECTORY_SEPARATOR . $cycle . DIRECTORY_SEPARATOR . $fileName;
            $file->move($this->uploadTemp . DIRECTORY_SEPARATOR . $cycle, $fileName);

            $extension = pathinfo($pathFile, PATHINFO_EXTENSION);
            $dataList = array();
            switch ($extension) {
                case 'xlsx':
                    $dataList = $this->readExel($pathFile);
                    break;
                case 'xls':
                    $dataList = $this->readExel($pathFile);
                    break;
                case 'txt':
                    $dataList = $this->readText($pathFile);
                    break;
                case 'sof':
                    $dataList = $this->readText($pathFile);
                    break;
                default:
                    return response()->json([
                        'status' => 303,
                        'message' => 'Error(303), File extension'
                    ]);
                    break;
            }

            if (array_key_exists('error', $dataList)) {
                \LogActivityUser::addToLog('Gagal UploadFile UploadController Log: '.$dataList);
                return response()->json([
                    'status' => 302,
                    'message' => "Error(302) " . $dataList
                ]);
            }

            $prod['product_id'] = $product_id;
            $prod['cycle'] = $cycle;
            $prod['file_name_upload'] = $fileName;
            $prod['path_file_upload'] = $pathFile;
            $prod['upload_by'] = $user->id;
            $id_prod = $this->insertToMaster($prod);

            $folder = $this->pathPdf . "/" . $product->product_name . "/" . str_replace('-', '', $cycle);
		if(!file_exists($this->pathPdf . "/" . $product->product_name)){
			mkdir($this->pathPdf . "/" . $product->product_name,0757,true);
			chmod($this->pathPdf . "/" . $product->product_name, 0757);
		}

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
		chmod($folder, 0757);
            }
	    

            foreach ($dataList as $key => $value) {
                $value['path_file'] = '/' . $product->product_name . "/" . str_replace('-', '', $cycle);
                $value['current_pos'] = $pos_id;
                $this->insertToDetail($value, $id_prod);
            }

            \LogActivityUser::addToLog('Sukses UploadFile UploadController ID: '.$id_prod);
            return response()->json([
                'status' => 200,
                'message' => "Success",
                'info_path' => "Mohon untuk upload file PDF ke FTP di lokasi <br> <strong style='color: black;'>$folder</strong>"
            ]);
        } else {
            \LogActivityUser::addToLog('Gagal UploadFile UploadController File not valid');
            return response()->json([
                'status' => 400,
                'message' => 'Error(400), File not valid'
            ]);
        }
    }

    public function getfile($no_account)
    {
        # code...
        $nmfile = DB::table('imaging_master_detail')->where('no_account', $no_account)->get();
        return $nmfile;
    }

    public function viewpdf($id, $nmfile, $cekfile = "", $max = 100)
    {
        # code...
        $userInfo = Auth::user();
        $host = request()->getHttpHost();
        $pdf = DB::table('imaging_master_detail')->where('id', '=', $id)->first();
        if ($userInfo->group_id == 3 && $host == "imaging.xptlp.co.id") {
            $sc = $this->pathPdf . $pdf->path_file .'/'. $pdf->no_account . '/' . $nmfile;
            $file = "/home/server01/PDF_ENC/$nmfile";
            if ($cekfile === "") {
                DB::table('imaging_tmp_pdf_enc')->insert([
                    'path_source' => $sc,
                    'path_dest' => $file,
                    'status' => 0
                ]);
            }            
        } else {
            $file = $this->pathPdf . $pdf->path_file .'/'. $pdf->no_account . '/' . $nmfile;            
        }

        if (file_exists($file)) {
            \LogActivityUser::addToLog('View PDF UploadController');
            DB::table('imaging_master_detail')->where('id', '=', $id)->increment('count_view');
            header('Content-Type: application/pdf');
            $fileread = readfile($file);
            if($userInfo->group_id == 3 && $host == "imaging.xptlp.co.id")
                unlink($file);
            echo $fileread;
        } else { 
            sleep(1);           
            if ($max > 0) {
                $max = $max - 1; $cekfile = "cekfile";
                return $this->viewpdf($id, $nmfile, $cekfile, $max);
            } else {
                return "<h5>File Not Found.. please refresh page ..<br>or Please Contact Admin..</h5>";
            }
        }        
    }

    public function renderView($id, $nmfile)
    {
        return view('viewpdf')->with('id', $id)->with('nmfile', $nmfile);
    }

    public function cetakList(Request $r)
    {
        # code...
        $id = \Crypt::decrypt($r->id);
        $data = DB::table('imaging_master')
            ->leftJoin('imaging_product', 'imaging_master.product_id', '=', 'imaging_product.id')
            ->leftJoin('imaging_customer', 'imaging_product.customer_id', '=', 'imaging_customer.id')
            ->select('imaging_master.*', 'imaging_product.product_name', 'imaging_customer.customer_name')
            ->where('imaging_master.id', $id)
            ->first();
        $detail = DB::table('imaging_master_detail')->where('id_master', $id)->groupBy('imaging_master_detail.no_account')->get();
        $nomanifest = DB::table('imaging_master_detail')->where('id_master', $id)->groupBy('no_manifest')->first();

        \LogActivityUser::addToLog('CetakList UploadController ID: '.$id);
        return view('imaging.cetak')->with([
            'data' => $data,
            'detail' => $detail,
            'nomanifest' => $nomanifest->no_manifest
        ]);
    }
}
