<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class CustomerController extends Controller
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
        $data = DB::table('imaging_customer')->orderBy('id','DESC')->get();
        return view('master.customer.listcust')->with('data',$data);
    }

    public function formcust()
    {
        # code...
        return view('master.customer.formcust');
    }

    public function addcust(Request $r)
    {
        # code...
        DB::table('imaging_customer')->insert([
            'customer_name' => $r->cust_name,
            'customer_pic' => $r->cust_pic,
            'customer_add' => $r->cust_add,
            'customer_telp' => $r->cust_telp,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back();
    }

    public function editcust($id)
    {
        # code...
        $data = DB::table('imaging_customer')->where('id',$id)->first();
        return view('master.customer.formcust')->with('data',$data);
    }

    public function savecust(Request $r)
    {
        # code...
        DB::table('imaging_customer')->where('id',$r->id)->update([
            'customer_name' => $r->cust_name,
            'customer_pic' => $r->cust_pic,
            'customer_add' => $r->cust_add,
            'customer_telp' => $r->cust_telp,
            'updated_at' => Carbon::now()            
        ]);
        return redirect()->route('master.customer');
    }

    public function deletecust($id)
    {
        # code...
        DB::table('imaging_customer')->where('id',$id)->delete();
        return redirect()->back();
    }
}
