<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class ProductController extends Controller
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
        $data = DB::table('imaging_product')
                ->join('imaging_customer','imaging_customer.id','=','imaging_product.customer_id')
                ->select('imaging_product.*','imaging_customer.customer_name')
                ->orderBy('id','DESC')->get();
        return view('master.product.listprod')->with('data',$data);
    }

    public function formprod()
    {
        # code...
        $customer = DB::table('imaging_customer')->orderBy('id','DESC')->get();
        return view('master.product.formprod')->with('customer',$customer);
    }

    public function addprod(Request $r)
    {
        # code...
        DB::table('imaging_product')->insert([
            'customer_id' => $r->customer_id,
            'product_name' => $r->product_name,
            'product_desc' => $r->product_desc,            
            'created_at' => Carbon::now()
        ]);

        return redirect()->back();
    }

    public function editprod($id)
    {
        # code...
        $data = DB::table('imaging_product')->where('id',$id)->first();
        $customer = DB::table('imaging_customer')->orderBy('id','DESC')->get();
        return view('master.product.formprod')->with('data',$data)->with('customer',$customer);
    }

    public function saveprod(Request $r)
    {
        # code...
        DB::table('imaging_product')->where('id',$r->id)->update([
            'customer_id' => $r->customer_id,
            'product_name' => $r->product_name,
            'product_desc' => $r->product_desc,            
            'updated_at' => Carbon::now()           
        ]);
        return redirect()->route('master.product');
    }

    public function deleteprod($id)
    {
        # code...
        DB::table('imaging_product')->where('id',$id)->delete();
        return redirect()->back();
    }
}
