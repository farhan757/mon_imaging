<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;
class UsersController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    //
    public function __construct()
    {
        $this->middleware('auth');
    }  
    
    public function index()
    {
        # code...
        $data = User::all();
        return view('master.users.listuser')->with('data',$data);
    }

    public function formuser()
    {
        # code...
        $group = DB::table('imaging_group')->get();
        return view('master.users.formuser')->with('group',$group);
    }

    public function adduser(Request $r)
    {
        # code...
        $aktif = 0;
        if($r->aktif){
            $aktif = 1;
        }        
        $this->validator($r->all());
        DB::table('users')->insert([
            'name' => $r->name,
            'username' => $r->username,
            'aktif' => $aktif,
            'email' => $r->email,
            'group_id' => $r->group,
            'password' => Hash::make($r->password),
            'created_at' => Carbon::now()
        ]);

        return redirect()->back();
    }

    public function saveuser(Request $r)
    {
        # code...
        $aktif = 0;
        if($r->aktif){
            $aktif = 1;
        }

        $this->validator($r->all());
        DB::table('users')->where('id',$r->id)->update([
            'name' => $r->name,
            'username' => $r->username,
            'aktif' =>  $aktif,            
            'email' => $r->email,
            'group_id' => $r->group, 
            'updated_at' => Carbon::now()           
        ]);
        if(($r->password == $r->password_confirmation) && ($r->password != '')){
            DB::table('users')->where('id',$r->id)->update([
                'password' => Hash::make($r->password)
            ]);
        }
        return redirect()->back();
    }

    public function edituser($id)
    {
        # code...
        $group = DB::table('imaging_group')->get();
        $data = DB::table('users')->where('id',$id)->first();
        return view('master.users.formuser')->with('data',$data)->with('group',$group);
    }

    public function deleteuser($id)
    {
        # code...
        DB::table('users')->where('id',$id)->delete();
        return redirect()->route('master.users');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:255',            
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);
    }

    public function replacemenu($id, Request $request)
    {
        DB::table('menus_to_users')->where('user_id','=',$id)->delete();
        foreach ($request->input('checkbox') as $key => $value) {
            DB::table('menus_to_users')
            ->insert([
                'user_id'=>$id,
                'menu_id'=>$value,
                'created_at'=>Carbon::now()                
            ]);
        }

        return redirect()->back()->with('info','Success change menu');
    }

    public function showmenuform($id)
    {
    	$menu = array();
       
        $mainmenu=DB::table('menus')
                    ->select('menus.*','user_menu.menu_id')
                    ->leftJoin(DB::raw('(select * from menus_to_users where user_id='.$id.') user_menu'), 'menus.id','=','user_menu.menu_id')
                    ->where('menus.parent','=',0)
                    ->orderBy('menus.order')
                    ->get();

        foreach ($mainmenu as $key => $value) {
            $menu[$key]['id']=$value->id;
            $menu[$key]['name']=$value->name_menu;
            $menu[$key]['url']=$value->url;
            $menu[$key]['icon']=$value->icon;
            $menu[$key]['desc']=$value->desc;
            if(!is_null($value->menu_id))
            	$menu[$key]['check']='checked';
            else $menu[$key]['check']='';
            $menu[$key]["contents"]=array();
            $submenu=DB::table('menus')
                        ->select('menus.*','user_menu.menu_id')
                        ->leftJoin(DB::raw('(select * from menus_to_users where user_id='.$id.') user_menu'), 'menus.id','=','user_menu.menu_id')
                        ->where('menus.parent','=',$value->id)
                        ->orderBy('menus.order')
                        ->get();
            foreach ($submenu as $key2 => $value2) {
                $menu[$key]['contents'][$key2]['id']=$value2->id;
                $menu[$key]['contents'][$key2]['name']=$value2->name_menu;
                $menu[$key]['contents'][$key2]['url']=$value2->url;
                $menu[$key]['contents'][$key2]['icon']=$value2->icon;
                if(!is_null($value2->menu_id))
            		$menu[$key]['contents'][$key2]['check']='checked';
            	else $menu[$key]['contents'][$key2]['check']='';
            }
        }
    	return view('master.users.user_menu')->with('menu',$menu);
    }    
}
