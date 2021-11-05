<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home2');
    }

    public function getLogActivity(){
        $data =  DB::table('log_activity_users')
        ->join('users','users.id','=','log_activity_users.user_id')
        ->select('users.name','log_activity_users.*')
        ->orderBy('log_activity_users.id','DESC')->limit('5')->get();
        return response()->json([
            'data' => $data
        ],200);
    }

    public function getrange($per = 'year', $info = 1, $start = null, $end = null)
    {
        $MONTHS = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Null');
        $query = DB::table('imaging_master_detail');

        switch ($info) {
            case 1:
                # code...
                $lb = "Document";
                $query = $query->select(DB::raw('COUNT(*) as jumlah'));
                break;
            case 2:
                # code...
                $lb = "Pages";
                $query = $query->select(DB::raw('SUM(imaging_master_detail.number_of_pages) as jumlah'));
                break;
            case 3:
                # code...
                $lb = "View PDF";
                $query = $query->select(DB::raw('SUM(imaging_master_detail.count_view) as jumlah'));
                break;
            default:
                # code...
                break;
        }

        $query = $query->addSelect(DB::raw('YEAR(imaging_master_detail.created_at) as tahun'));
        if ($start != null && $end != null) {
            $query = $query->where('imaging_master_detail.created_at', '>=', $start . ' 00:00:00')->where('imaging_master_detail.created_at', '<=', $end . ' 23:59:59');
        }
        if ($per == 'month' || $per == 'day') {
            $query = $query->addSelect(DB::raw('MONTH(imaging_master_detail.created_at) as bulan'));
        }
        if ($per == 'day') {
            $query = $query->addSelect(DB::raw('DAY(imaging_master_detail.created_at) as tanggal'));
        }
       
        switch ($per) {
            case 'day':
                $query = $query->groupBy('tahun', 'bulan', 'tanggal');
                break;
            case 'month':
                $query = $query->groupBy('tahun', 'bulan');
                break;
            default:
            $query = $query->groupBy('tahun');
                break;
        }        
        $data = $query->get();

        $nwArray = array();
        $nwArray['total'] = array();
        $nwArray['labels'] = array();

        $total = 0;

        foreach ($data as $key => $value) {
            array_push($nwArray['total'], $value->jumlah);

            $total = $total + $value->jumlah;
            if ($per == 'month' || $per == 'day') {
                if ($value->bulan == null) $bulan = "Null";
                else {
                    $bulan = $MONTHS[$value->bulan - 1];
                }
            }
            switch ($per) {
                case 'day':
                    array_push($nwArray['labels'], $value->tanggal . "-" . $bulan . "-" . $value->tahun);
                    break;
                case 'month':
                    array_push($nwArray['labels'], $bulan . "-" . $value->tahun);
                    break;
                default:
                    array_push($nwArray['labels'], $value->tahun);
                    break;
            }
        }
        $nwArray['lbl_total'] = number_format($total);
        $nwArray['lbl_info'] = $lb;        
        return response()->json($nwArray);
    }

    public function getDoc()
    {
        # code...
        $data = DB::table('imaging_master_detail')
                ->select(DB::raw('count(*) as jumlah'))->first();
        return $data->jumlah;
    }

    public function getPage()
    {
        # code...
        $data = DB::table('imaging_master_detail')
                ->select(DB::raw('sum(number_of_pages) as jumlah'))->first();
        return $data->jumlah;        
    }

    public function getViewPDF()
    {
        # code...
        $data = DB::table('imaging_master_detail')
                ->select(DB::raw('sum(count_view) as jumlah'))->first();
        return $data->jumlah;        
    }
}
