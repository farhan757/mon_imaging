<?php

namespace App\Http\Controllers\MailBlast\Progress;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
class ProgressController extends Controller
{
    //
    public function index(Request $r)
    {
        $noaccount = $r->noaccount;
        $nospaj = $r->nospaj;
        $from = $r->cycle;
        $end = $r->cycle2;
        $product_id = $r->product_id;
        if ($r->paginate != '') {
            $paginate = $r->paginate;
        } else {
            $paginate = 10;
        }

        $auth = Auth::user();
        $data = DB::table('mail_sending_data');
        $data = $data->join('mail_master', 'mail_master.id', '=', 'mail_sending_data.master_id')
            ->leftJoin('imaging_product', 'imaging_product.id', '=', 'mail_master.product_id');

        if ($noaccount != '') {
            $data = $data->where('mail_sending_data.account', '=', $noaccount);
        }
        if($nospaj !=''){
            $data = $data->where('mail_sending_data.no_spaj','=',$nospaj);
        }
        if($from != '' && $end != ''){
            $data = $data->where('mail_master.cycle','>=',$from)->where('mail_master.cycle','<=',$end);
        }
        if ($product_id != '') {
            $data = $data->where('mail_master.product_id', '=', $product_id);
        }

        $data = $data->select('mail_sending_data.*', 'imaging_product.product_name','mail_master.cycle');

        if($r->submit == 'export'){
            $data = $data->orderBy('mail_sending_data.id','DESC')->get();
            $spreadsheet = new Spreadsheet();            
            
            $spreadsheet->setActiveSheetIndex(0);
            $spreadsheet->getActiveSheet()->SetCellValue('A1','No');
            $spreadsheet->getActiveSheet()->SetCellValue('B1','No Account');
            $spreadsheet->getActiveSheet()->SetCellValue('C1','No Spaj');
            $spreadsheet->getActiveSheet()->SetCellValue('D1','Name');
            $spreadsheet->getActiveSheet()->SetCellValue('E1','Product Name');
            $spreadsheet->getActiveSheet()->SetCellValue('F1','Cycle');
            $spreadsheet->getActiveSheet()->SetCellValue('G1','Email');
            $spreadsheet->getActiveSheet()->SetCellValue('H1','Status');
            $spreadsheet->getActiveSheet()->SetCellValue('I1','Msg Error Send');
            $spreadsheet->getActiveSheet()->SetCellValue('J1','Send At');
            $spreadsheet->getActiveSheet()->SetCellValue('K1','Read Count');
            $spreadsheet->getActiveSheet()->SetCellValue('L1','Read At');
            $spreadsheet->getActiveSheet()->SetCellValue('M1','Keterangan');
            //$spreadsheet->getActiveSheet()->SetCellValue('K1','Link PDF');

            $row=1;
            foreach($data as $v){
                
                $row++;
                $spreadsheet->getActiveSheet()->SetCellValue('A'.$row,$row-1);
                $spreadsheet->getActiveSheet()->SetCellValue('B'.$row,$v->account);
                $spreadsheet->getActiveSheet()->SetCellValue('C'.$row,$v->no_spaj);
                $spreadsheet->getActiveSheet()->SetCellValue('D'.$row,$v->name);
                $spreadsheet->getActiveSheet()->SetCellValue('E'.$row,$v->product_name);
                $spreadsheet->getActiveSheet()->SetCellValue('F'.$row,$v->cycle);
                $spreadsheet->getActiveSheet()->SetCellValue('G'.$row,$v->to);
                $spreadsheet->getActiveSheet()->SetCellValue('H'.$row,$v->sent);
                $spreadsheet->getActiveSheet()->SetCellValue('I'.$row,$v->msg_error_send);
                $spreadsheet->getActiveSheet()->SetCellValue('J'.$row,$v->send_at);
                $spreadsheet->getActiveSheet()->SetCellValue('K'.$row,$v->read);
                $spreadsheet->getActiveSheet()->SetCellValue('L'.$row,$v->read_at);
                $spreadsheet->getActiveSheet()->SetCellValue('M'.$row,$v->desc);
                //$spreadsheet->getActiveSheet()->getHyperlink('K'.$row,$v->file_name)->setUrl($link);
                //$sheet->setCellValue('L'.$row,"=Hyperlink('$link','$v->file_name')");                
            }
            $spreadsheet->getActiveSheet()->setTitle('Sheet1');
            $spreadsheet->setActiveSheetIndex(0);

            \LogActivityUser::addToLog('Download Report Detail');
            $writer = IOFactory::createWriter($spreadsheet,'Xlsx');
            $filename = "ReportEmailBlast-$from-$end.xlsx";
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
        }

        $data = $data->orderBy('mail_sending_data.id', 'DESC')->paginate($paginate);

        $product = DB::table('imaging_product')->get();

        $view = view('mailblast.progress.listdatamailprog');
        $view->with([
            'data' => $data,
            'product' => $product,
            'noaccount' => $noaccount,
            'nospaj' => $nospaj,
            'cycle' => $from,
            'cycle2' => $end,
            'product_id' => $product_id,
            'paginate' => $paginate
        ]);
        return $view;
    }

    public function detail($id)
    {
        # code...
        $id_dec = \Crypt::decrypt($id);
        $data = DB::table('mail_sending_data')
            ->select('mail_sending_data.*', DB::raw('users.name as username'))
            ->join('users', 'users.id', '=', 'mail_sending_data.user_id')
            ->where('mail_sending_data.id', '=', $id_dec)->first();

        $view = view('mailblast.progress.detail');
        $view->with('data', $data);
        return $view;
    }

    public function getInfoResend(Request $r)
    {
        # code...
        $id_dec = $r->id;
        $data = DB::table('mail_sending_data')
            ->select('mail_sending_data.*', DB::raw('users.name as username'))
            ->join('users', 'users.id', '=', 'mail_sending_data.user_id')
            ->where('mail_sending_data.id', '=', $id_dec)->first();

        return response()->json(
            [
                'data' => $data
            ]
        );
    }

    public function resend(Request $request)
    {
        # code...
        $id = $request->id;
        $email = $request->email;
        $desc = $request->desc;

        $error = "";
        $body_mail_final = "";
        # code...
        $getData = DB::table('mail_sending_data')->where('id', $id)->first();

        DB::beginTransaction();
        try {
            $idSending = DB::table('mail_sending_data')->insertGetId([
                'master_id' => $getData->master_id,
                'account' => $getData->account,
                'no_spaj' => $getData->no_spaj,
                'name' => $getData->name,
                'to' => $email,
                'cc' => $getData->cc,
                'bcc' => $getData->bcc,
                'subject_mail' => $getData->subject_mail,
                'body_mail_base' => $getData->body_mail_base,
                'attachment' => $getData->attachment,
                'password_attach' => $getData->password_attach,
                'user_id' => Auth::id(),
                'resend' => 1,
                'desc' => $desc,
                'flaging' => $getData->flaging,
                'id_mail' => $getData->id_mail,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $body_mail_final = $this->MailbuildCodeVerifymail($idSending, $getData->body_mail_base);

            DB::table('mail_sending_data')->where('id', $idSending)->update([
                'body_mail' => $body_mail_final
            ]);

            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Resending Success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            $error = $e;
        }
        return response()->json([
            'status' => 500,
            'message' => $error
        ]);
    }
}
