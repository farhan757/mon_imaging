<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class MenuController extends Controller
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
    public function menu($child = 0)
    {
        # code...
        $user_id = Auth::id();
        $menus = DB::table('menus_to_users')
                ->join('menus','menus.id','=','menus_to_users.menu_id')
                ->where('menus.active','=',1)->where('menus_to_users.user_id','=',$user_id)
                ->where('menus.parent','=',$child)
                ->orderBy('menus.order','ASC')->get();
        return $menus;
    }
}
