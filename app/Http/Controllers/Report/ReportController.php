<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
class ReportController extends Controller
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
    public function listDetail(Request $r)
    {
        # code...
        $noaccount = $r->noaccount;
        $nobox = $r->nobox;
        $from = $r->cycle;
        $end = $r->cycle2;
        $product_id = $r->product_id;
        if($r->paginate != ''){
            $paginate = $r->paginate;
        }else{
            $paginate = 10;
        }
        
        $data = DB::table('imaging_master')
                ->join('imaging_master_detail','imaging_master_detail.id_master','=','imaging_master.id')
                ->join('imaging_product','imaging_product.id','=','imaging_master.product_id')
                ->join('imaging_pos','imaging_pos.id','=','imaging_master_detail.current_pos')
                ->select('imaging_product.product_name','imaging_master_detail.id','imaging_master.cycle')
                ->addSelect('imaging_master_detail.no_account','imaging_master_detail.no_box','imaging_master_detail.file_name')
                ->addSelect('imaging_master_detail.no_manifest','imaging_master_detail.no_doc')
                ->addSelect('imaging_master_detail.number_of_pages','imaging_master_detail.created_at')
                ->addSelect('imaging_master_detail.tgl_scan')
                ->addSelect('imaging_pos.pos_name','imaging_pos.pos_lokasi');                

        if($noaccount != ''){
            $data = $data->where('imaging_master_detail.no_account','=',$noaccount);
        }
        if($nobox !=''){
            $data = $data->where('imaging_master_detail.no_box','=',$nobox);
        }
        if($from != '' && $end != ''){
            $data = $data->where('imaging_master.cycle','>=',$from)->where('imaging_master.cycle','<=',$end);
        }
        if($product_id != ''){
            $data = $data->where('imaging_master.product_id','=',$product_id);
        }

        if($r->submit == 'export'){
            $data = $data->orderBy('imaging_master_detail.id','DESC')->get();
            $spreadsheet = new Spreadsheet();            
            
            $spreadsheet->setActiveSheetIndex(0);
            $spreadsheet->getActiveSheet()->SetCellValue('A1','No');
            $spreadsheet->getActiveSheet()->SetCellValue('B1','No Account');
            $spreadsheet->getActiveSheet()->SetCellValue('C1','Product Name');
            $spreadsheet->getActiveSheet()->SetCellValue('D1','Cycle');
            $spreadsheet->getActiveSheet()->SetCellValue('E1','Current Pos');
            $spreadsheet->getActiveSheet()->SetCellValue('F1','Number Of Pages');
            $spreadsheet->getActiveSheet()->SetCellValue('G1','No Box');
            $spreadsheet->getActiveSheet()->SetCellValue('H1','No Manifest');
            $spreadsheet->getActiveSheet()->SetCellValue('I1','No Doc');
            $spreadsheet->getActiveSheet()->SetCellValue('J1','Created At');
            //$spreadsheet->getActiveSheet()->SetCellValue('K1','Link PDF');

            $row=1;
            foreach($data as $v){
                $link = "http://localhost:8081/mon_imaging/public/imaging/view-pdf-imaging/$v->id/$v->file_name";
                $row++;
                $spreadsheet->getActiveSheet()->SetCellValue('A'.$row,$row-1);
                $spreadsheet->getActiveSheet()->SetCellValue('B'.$row,$v->no_account);
                $spreadsheet->getActiveSheet()->SetCellValue('C'.$row,$v->product_name);
                $spreadsheet->getActiveSheet()->SetCellValue('D'.$row,$v->cycle);
                $spreadsheet->getActiveSheet()->SetCellValue('E'.$row,$v->pos_name.'['.$v->pos_lokasi.']');
                $spreadsheet->getActiveSheet()->SetCellValue('F'.$row,$v->number_of_pages);
                $spreadsheet->getActiveSheet()->SetCellValue('G'.$row,$v->no_box);
                $spreadsheet->getActiveSheet()->SetCellValue('H'.$row,$v->no_manifest);
                $spreadsheet->getActiveSheet()->SetCellValue('I'.$row,$v->no_doc);
                $spreadsheet->getActiveSheet()->SetCellValue('J'.$row,$v->created_at);
                //$spreadsheet->getActiveSheet()->getHyperlink('K'.$row,$v->file_name)->setUrl($link);
                //$sheet->setCellValue('L'.$row,"=Hyperlink('$link','$v->file_name')");                
            }
            $spreadsheet->getActiveSheet()->setTitle('Sheet1');
            $spreadsheet->setActiveSheetIndex(0);

            \LogActivityUser::addToLog('Download Report Detail');
            $writer = IOFactory::createWriter($spreadsheet,'Xlsx');
            $filename = "Report-$from-$end.xlsx";
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
        }

        $data = $data->orderBy('imaging_master_detail.id','DESC')->paginate($paginate);
        
        $product = DB::table('imaging_product')->get();

        \LogActivityUser::addToLog('View Report Detail');
        return view('report.list')->with([
            'data' => $data,
            'product' => $product,
            'noaccount' => $noaccount,
            'nobox' => $nobox,
            'cycle' => $from,
            'cycle2' => $end,
            'product_id' => $product_id,
            'paginate' => $paginate
        ]);
    }

    public function summary(Request $r)
    {
        # code...        
        $nobox = $r->nobox;
        //$from = $r->cycle;
        //$end = $r->cycle2;
        $product_id = $r->product_id;
        if($r->paginate != ''){
            $paginate = $r->paginate;
        }else{
            $paginate = 10;
        }
        
        /*$data = DB::query()->fromSub(function ($query){
            $query->from('imaging_master')
            ->join('imaging_master_detail','imaging_master_detail.id_master','=','imaging_master.id')
            ->join('imaging_product','imaging_product.id','=','imaging_master.product_id')
            ->select('imaging_master_detail.no_manifest','imaging_master.id','imaging_master_detail.no_box','imaging_master.created_at','imaging_product.product_name')
            ->addSelect('imaging_master.cycle',DB::raw('SUM(imaging_master_detail.number_of_pages) AS jml_pages'))
            ->addSelect('imaging_master.product_id')
            ->groupBy('imaging_master_detail.no_box');
        },'tmp');*/
        
        $data = DB::query()->fromSub(function ($query){
            $query->from('imaging_master_detail')
            ->select(DB::raw('SUM(imaging_master_detail.`number_of_pages`) AS jml_pages, imaging_master_detail.*'))
            ->groupBy('imaging_master_detail.no_manifest');
        },'tmp')->join('imaging_master','imaging_master.id','=','tmp.id_master')
        ->join('imaging_product','imaging_product.id','=','imaging_master.product_id');
        
        $data = $data->addSelect(DB::raw('tmp.id_master, COUNT(tmp.no_manifest) AS jml_manifest, tmp.no_box, SUM(tmp.jml_pages) AS jm_pages, imaging_product.`product_name`, imaging_product.id'));
        if($nobox !=''){
            $data = $data->where('tmp.no_box','=',$nobox);
        }
        /*if($from != '' && $end != ''){
            $data = $data->where('tmp.cycle','>=',$from)->where('tmp.cycle','<=',$end);
        }*/
        if($product_id != ''){
            $data = $data->where('imaging_master.product_id','=',$product_id);
        }

        $data = $data->groupBy('tmp.no_box','imaging_product.product_name');
        if($r->submit == 'export'){
            $data = $data->get();
            $spreadsheet = new Spreadsheet();            
            
            $spreadsheet->setActiveSheetIndex(0);
            $spreadsheet->getActiveSheet()->SetCellValue('A1','No');
            $spreadsheet->getActiveSheet()->SetCellValue('B1','No Box');
            $spreadsheet->getActiveSheet()->SetCellValue('C1','Product Name');
            $spreadsheet->getActiveSheet()->SetCellValue('D1','Cycle');
            $spreadsheet->getActiveSheet()->SetCellValue('E1','Total Account');
            $spreadsheet->getActiveSheet()->SetCellValue('F1','Total Pages');
            $spreadsheet->getActiveSheet()->SetCellValue('G1','Created At');
            //$spreadsheet->getActiveSheet()->SetCellValue('K1','Link PDF');

            $row=1;
            foreach($data as $v){
                //$link = "http://localhost:8081/mon_imaging/public/imaging/view-pdf-imaging/$v->id/$v->file_name";
                $row++;
                $spreadsheet->getActiveSheet()->SetCellValue('A'.$row,$row-1);
                $spreadsheet->getActiveSheet()->SetCellValue('B'.$row,$v->no_box);
                $spreadsheet->getActiveSheet()->SetCellValue('C'.$row,$v->product_name);
                //$spreadsheet->getActiveSheet()->SetCellValue('D'.$row,$v->cycle);
                $spreadsheet->getActiveSheet()->SetCellValue('E'.$row,$v->jml_manifest);
                $spreadsheet->getActiveSheet()->SetCellValue('F'.$row,$v->jm_pages);
                //$spreadsheet->getActiveSheet()->SetCellValue('G'.$row,$v->created_at);
                //$spreadsheet->getActiveSheet()->getHyperlink('K'.$row,$v->file_name)->setUrl($link);
                //$sheet->setCellValue('L'.$row,"=Hyperlink('$link','$v->file_name')");                
            }
            $spreadsheet->getActiveSheet()->setTitle('Sheet1');
            $spreadsheet->setActiveSheetIndex(0);
            \LogActivityUser::addToLog('Download Report Summary');
            $writer = IOFactory::createWriter($spreadsheet,'Xlsx');
            $filename = "Report-Summary.xlsx";
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
        }
        
        $data = $data->orderBy('tmp.id_master','desc')->paginate($paginate);
        
        $product = DB::table('imaging_product')->get();
        \LogActivityUser::addToLog('View Report Summary');
        return view('report.listsummary')->with([
            'data' => $data,
            'product' => $product,
            'nobox' => $nobox,
            //'cycle' => $from,
            //'cycle2' => $end,
            'product_id' => $product_id,
            'paginate' => $paginate
        ]);
        //dd($data);
    }

    public function cetakList(Request $r)
    {
        # code...
        $data = DB::table('imaging_master')
                ->join('imaging_product','imaging_product.id','=','imaging_master.product_id')
                ->join('imaging_customer','imaging_customer.id','=','imaging_product.customer_id')
                ->where('imaging_master.id',$r->id_master)->first();
        $detail = DB::table('imaging_master_detail')
                    ->join('imaging_master','imaging_master.id','=','imaging_master_detail.id_master')
                    ->where('imaging_master_detail.no_box',$r->nobox)->where('imaging_master.product_id',$r->id_prod)
                    ->groupBy('imaging_master_detail.no_manifest')->get();        
        
        \LogActivityUser::addToLog('Cetak list Box '.$r->nobox);
        return view('report.cetak')->with([
            'data' => $data,
            'detail' => $detail,
            'nobox' => $r->nobox
        ]);
    }
}
