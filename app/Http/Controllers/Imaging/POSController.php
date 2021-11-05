<?php

namespace App\Http\Controllers\Imaging;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class POSController extends Controller
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
    //backup coy
    /*public function index(Request $r)
    {
        # code...
        $data = DB::table("imaging_master")
            ->join('imaging_master_detail', 'imaging_master_detail.id_master', '=', 'imaging_master.id')
            ->leftJoin('imaging_product', 'imaging_product.id', '=', 'imaging_master.product_id')            
            ->select('imaging_master.product_id', 'imaging_master.cycle', 'imaging_master.created_at', 'imaging_master_detail.*')
            ->where('imaging_master.product_id', 1)->groupBy('imaging_master_detail.no_account')->get();
        $kriteria = DB::table('imaging_kriteria')->get();

        if ($r->download == "download") {
            \LogActivityUser::addToLog('Download PDF POS ZIP cycle '.$r->cycfrom.'-'.$r->cycto);
            $d = DB::table("imaging_master")
                ->join('imaging_master_detail', 'imaging_master_detail.id_master', '=', 'imaging_master.id')
                ->leftJoin('imaging_product', 'imaging_product.id', '=', 'imaging_master.product_id')
                ->where('imaging_master.cycle', '>=', $r->cycfrom)->where('imaging_master.cycle', '<=', $r->cycto)
                ->where('imaging_master.product_id', 1)->groupBy('imaging_master.cycle')
                ->orderBy('imaging_master.cycle', 'ASC')->get();


            //dd($data);
            // Get real path for our folder
            $zip = new ZipArchive();
            $rootPath = realpath($this->pathPdf);
            $filenameZip = 'Pdf cycle ' . $r->cycfrom . '-' . $r->cycto . '.zip';
            $zip->open($filenameZip, ZipArchive::CREATE | ZipArchive::OVERWRITE);
            foreach ($d as $data) {

                $dd = DB::table("imaging_master")
                    ->join('imaging_master_detail', 'imaging_master_detail.id_master', '=', 'imaging_master.id')                    
                    ->where('imaging_master.cycle', '=', $data->cycle)
                    ->where('imaging_master.product_id', 1)->groupBy('imaging_master_detail.no_account')
                    ->get();

                foreach ($dd as $par) {
                    // Create recursive directory iterator
                    /** @var SplFileInfo[] $files 
                    $rootPath2 = realpath($rootPath.$par->path_file.'/'.$par->no_account);
                    $files = new RecursiveIteratorIterator(
                        new RecursiveDirectoryIterator($rootPath2),
                        RecursiveIteratorIterator::LEAVES_ONLY
                    );
                    //dd($files);
                    foreach ($files as $name => $file) {
                        // Skip directories (they would be added automatically)
                        if (!$file->isDir()) {
                            // Get real and relative path for current file
                            $filePath = $file->getRealPath();
                            $relativePath = substr($filePath, strlen($rootPath) + 1);                            
                            // Add current file to archive
                            $zip->addFile($filePath, $relativePath);
                            
                        }
                    }
                }
            }
            // Zip archive will be created only after closing object
            $zip->close();
            if(count($d) > 0){
                return response()->download(realpath($filenameZip))->deleteFileAfterSend();
            }else{
                return view('imaging.POS.listdataimaging')->with('data', $data)->with('kriteria',$kriteria);
            }
            
        }

        \LogActivityUser::addToLog('View List POS');
        return view('imaging.POS.listdataimaging')->with('data', $data)->with('kriteria',$kriteria);
    } */   
    //
    public function index(Request $r)
    {
        # code...
        $data = DB::table("imaging_master")
            ->join('imaging_master_detail', 'imaging_master_detail.id_master', '=', 'imaging_master.id')
            ->leftJoin('imaging_product', 'imaging_product.id', '=', 'imaging_master.product_id')
            ->leftJoin('imaging_kriteria','imaging_master_detail.id_kriteria','=','imaging_kriteria.id_kriteria')
            ->select('imaging_master.product_id', 'imaging_master.cycle', 'imaging_master.created_at', 'imaging_master_detail.*','imaging_kriteria.nama_kriteria')
            ->where('imaging_master.product_id', 1)->get();
        $kriteria = DB::table('imaging_kriteria')->get();

        if ($r->download == "download") {
            \LogActivityUser::addToLog('Download PDF POS ZIP cycle '.$r->cycfrom.'-'.$r->cycto);
            $d = DB::table("imaging_master")
                ->join('imaging_master_detail', 'imaging_master_detail.id_master', '=', 'imaging_master.id')
                ->leftJoin('imaging_product', 'imaging_product.id', '=', 'imaging_master.product_id')
                ->where('imaging_master.cycle', '>=', $r->cycfrom)->where('imaging_master.cycle', '<=', $r->cycto)
                ->where('imaging_master.product_id', 1)->groupBy('imaging_master.cycle')
                ->orderBy('imaging_master.cycle', 'ASC')->get();


            //dd($data);
            // Get real path for our folder
            $zip = new ZipArchive();
            $rootPath = realpath($this->pathPdf);
            $filenameZip = 'Pdf cycle ' . $r->cycfrom . '-' . $r->cycto . '.zip';
            $zip->open($filenameZip, ZipArchive::CREATE | ZipArchive::OVERWRITE);
            foreach ($d as $data) {

                $dd = DB::table("imaging_master")
                    ->join('imaging_master_detail', 'imaging_master_detail.id_master', '=', 'imaging_master.id')                    
                    ->where('imaging_master.cycle', '=', $data->cycle)
                    ->where('imaging_master.product_id', 1)->groupBy('imaging_master_detail.no_account')
                    ->get();

                foreach ($dd as $par) {
                    // Create recursive directory iterator
                    /** @var SplFileInfo[] $files */
                    $rootPath2 = realpath($rootPath.$par->path_file.'/'.$par->no_account);
                    $files = new RecursiveIteratorIterator(
                        new RecursiveDirectoryIterator($rootPath2),
                        RecursiveIteratorIterator::LEAVES_ONLY
                    );
                    //dd($files);
                    foreach ($files as $name => $file) {
                        // Skip directories (they would be added automatically)
                        if (!$file->isDir()) {
                            // Get real and relative path for current file
                            $filePath = $file->getRealPath();
                            $relativePath = substr($filePath, strlen($rootPath) + 1);                            
                            // Add current file to archive
                            $zip->addFile($filePath, $relativePath);
                            
                        }
                    }
                }
            }
            // Zip archive will be created only after closing object
            $zip->close();
            if(count($d) > 0){
                return response()->download(realpath($filenameZip))->deleteFileAfterSend();
            }else{
                return view('imaging.POS.listdataimaging')->with('data', $data)->with('kriteria',$kriteria);
            }
            
        }

        \LogActivityUser::addToLog('View List POS');
        return view('imaging.POS.listdataimaging')->with('data', $data)->with('kriteria',$kriteria);
    }

    public function delete(Request $r)
    {
        # code...
        $id = $r->id;
        //$nopol = $r->nopol;
        //$cyc = $r->cycle;
        DB::beginTransaction();
        try {
            /*DB::table('imaging_master_detail')
                ->where('imaging_master_detail.no_account', '=', $nopol)
                ->where('imaging_master_detail.id_master', $id)->delete();*/
            DB::table('imaging_master_detail')
                //->where('imaging_master_detail.no_account', '=', $nopol)
                ->where('imaging_master_detail.id', $id)->delete();            
            DB::commit();
            \LogActivityUser::addToLog('Sukses Delete POSController Id : ' . $id , 2);
            return response()->json([
                'status' => 200,
                'message' => "Success",
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            \LogActivityUser::addToLog('Gagal Delete POSController Id : ' . $id . ' Eror:' . $e, 2);
            return response()->json([
                'status' => 500,
                'message' => "Failed",
            ]);
        }
    }

    public function detail(Request $r)
    {
        # code...
        $id = $r->id;
        $nopol = $r->nopol;
        $master = DB::table('imaging_master_detail')->where('id_master', '=', $id)->where('no_account', '=', $nopol)->first();
        $detail = DB::table('imaging_master_detail')->where('imaging_master_detail.id_master', '=', $id)->where('imaging_master_detail.no_account', '=', $nopol)
            ->get();
        \LogActivityUser::addToLog('Detail POSController ID : ' . $id . ' Nopol :' . $nopol);
        return view('imaging.POS.detail')->with(['detail' => $detail, 'value' => $master]);
    }

    public function getPerKriteria($id,$nopol,$kriteria,$kriterias){ 
        $master = DB::table('imaging_master')->where('id', '=', $id)->first();       
        $detail = DB::table('imaging_master_detail')->where('imaging_master_detail.id_master', '=', $id)->where('imaging_master_detail.id_kriteria',$kriteria)->where('imaging_master_detail.no_account', '=', $nopol)
                ->get();
        \LogActivityUser::addToLog('Detail POSController ID : ' . $id . ' Nopol :' . $nopol);
        return view('imaging.POS.detailpos')->with(['detail' => $detail, 'value' => $master, 'kriteria' => $kriterias ]);
    }
}
