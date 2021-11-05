<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class PosLocController extends Controller
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
        $data = DB::table('imaging_pos')
                ->orderBy('id','DESC')->get();
        return view('master.pos.listpos')->with('data',$data);
    }

    public function formpos()
    {
        # code...
        $pos = DB::table('imaging_pos')->orderBy('id','DESC')->get();
        return view('master.pos.formpos')->with('pos',$pos);
    }

    public function addpos(Request $r)
    {
        # code...
        DB::table('imaging_pos')->insert([
            'pos_name' => $r->pos_name,
            'pos_lokasi' => $r->pos_lokasi,
            'pos_alamat' => $r->pos_alamat,            
            'created_at' => Carbon::now()
        ]);

        return redirect()->back();
    }

    public function editpos($id)
    {
        # code...
        $data = DB::table('imaging_pos')->where('id',$id)->first();
        
        return view('master.pos.formpos')->with('data',$data);
    }

    public function savepos(Request $r)
    {
        # code...
        DB::table('imaging_pos')->where('id',$r->id)->update([
            'pos_name' => $r->pos_name,
            'pos_lokasi' => $r->pos_lokasi,
            'pos_alamat' => $r->pos_alamat,            
            'created_at' => Carbon::now()           
        ]);
        return redirect()->route('master.posloc');
    }

    public function deletepos($id)
    {
        # code...
        DB::table('imaging_pos')->where('id',$id)->delete();
        return redirect()->back();
    }    
}
