<?php

namespace App\Http\Controllers\Mutation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Exception;

class MutationController extends Controller
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
        $pos = DB::table('imaging_pos')->where('id','>',1)->get();
        $nobox = DB::table('imaging_master_detail')
                 ->where('current_pos',1)
                 ->groupBy('no_box')->get();
        \LogActivityUser::addToLog('View Mutation List');                 
        return view('mutation.form')->with('pos',$pos)->with('nobox',$nobox);
    }

    public function save(Request $r)
    {
        # code...  
        $data = "";      
        $no_bast = $this->no_bast();
        DB::beginTransaction();
        foreach($r->input('nobox') as $value){
            $nobox = $value;
            $pos = $r->pos;
            $pickupby = $r->pu;
            $before_pos = DB::table('imaging_master_detail')->where('no_box',$nobox)->first();
            try{
                DB::table('imaging_bast')->insert([
                    'no_bast' =>$no_bast,
                    'no_box' => $nobox,
                    'pickupBy' => $pickupby,
                    'created_at' => Carbon::now()
                ]);
                DB::table('imaging_master_detail')->where('no_box',$nobox)->update([
                    'before_pos' => $before_pos->current_pos,
                    'current_pos' => $pos
                ]);
                DB::commit();
                $data = array(
                    'status' => 1,
                    'message' => 'Mutation Success. No BAST ',
                    'no_bast' => $no_bast
                );
                  
            }catch(Exception $e){
                DB::rollBack();
                $data = array(
                    'status' => 0,
                    'message' => 'Mutation Failed '.$e
                );                
            }
        }
        \LogActivityUser::addToLog('Mutation Box no Bast '.$no_bast);
        return redirect()->route('mutation.form')->with('msg',$data);     
    }

    public function cetak($no_bast)
    {
        # code...
        $data = DB::table('imaging_bast')
                ->joinSub(function ($query){
                    $query->from('imaging_master_detail')
                            ->groupBy('imaging_master_detail.no_account')->get();
                },'tmp','tmp.no_box','=','imaging_bast.no_box')
                ->join('imaging_master','imaging_master.id','=','tmp.id_master')
                ->join('imaging_pos','imaging_pos.id','=','tmp.before_pos')
                ->join('imaging_pos as img_pos',DB::raw('img_pos.id'),'=','tmp.current_pos')
                ->select(DB::raw('COUNT(imaging_bast.no_box) AS jml_count'))
                ->addSelect('imaging_bast.*',DB::raw('imaging_pos.pos_name AS bef_pos'),DB::raw('imaging_pos.`pos_lokasi` AS bef_lok'))
                ->addSelect(DB::raw('imaging_pos.pos_alamat AS bef_alm'),DB::raw('img_pos.`pos_name` AS cur_pos'))
                ->addSelect(DB::raw('img_pos.`pos_lokasi` AS cur_lok'),DB::raw('img_pos.`pos_alamat` AS cur_alm'))
                ->where('imaging_bast.no_bast','=',$no_bast)
                ->groupBy('imaging_bast.no_box');
        $data = $data->get();
        $first = $data->first(); 
        \LogActivityUser::addToLog('Cetak no Bast '.$no_bast);               
        //dd($data);
        $view = view('mutation.cetak');
        $view->with('nobast',$no_bast); 
        $view->with('data',$data); $view->with('pos',$first); 
        return $view;      
    }
}
