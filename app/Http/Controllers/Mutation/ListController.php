<?php

namespace App\Http\Controllers\Mutation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ListController extends Controller
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
    public function index(Request $r)
    {
        # code...
        $nobast = $r->nobast;
        $page = 10;
        if($r->paginate != '')
        {
            $page = $r->paginate;
        }
        
        $data = DB::table('imaging_bast');
        
        if($nobast != ''){
            $data = $data->where('no_bast',$nobast);
        }
        $data = $data->select('imaging_bast.*',DB::raw('count(imaging_bast.no_bast) as jml_box'));
        $data = $data->groupBy('no_bast')->orderBy('created_at','DESC')->paginate($page);
        
        return view('mutation.list')->with('data',$data)->with('nobast',$nobast)->with('paginate',$page);
    }
}
