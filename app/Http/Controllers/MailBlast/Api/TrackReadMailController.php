<?php

namespace App\Http\Controllers\MailBlast\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class TrackReadMailController extends Controller
{
    //
    public function index($code, Request $request)
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $querystring = $this->tidy($_SERVER['QUERY_STRING']);
        $useragent = $this->tidy($_SERVER['HTTP_USER_AGENT']);

        /*$json  = file_get_contents("https://ipinfo.io/".$ip."/geo");
        if(($json<>'')&&(strpos($json,"error")===false)){ extract(json_decode($json ,true)); }
        $country=$this->tidy($country);
        $prov=$this->tidy($region);
        $city=$this->tidy($city);
        list($lat,$lon)=explode(',',$loc);
        $lat=$this->tidy($lat);
        $lon=$this->tidy($lon);  */

        # code...
        $img = DB::table('mail_tmp_verify_read')->where('code_verify', '=', $code)->first();
        if (!is_null($img)) {
            DB::table('mail_tmp_history_read')->insert([
                'sending_id' => $img->sending_id,
                'ip' => $ip,
                'web_browser' => $useragent,
                'created_at' => Carbon::now()
            ]);
            DB::table('mail_sending_data')->where('id', $img->sending_id)
                ->increment('read', 1, ['read_at' => Carbon::now()]);
        }
        //$file = file_get_contents(public_path().'/img/img.png');
        //return response($file)->header('Content-type','image/png');
        //Get the filesize of the image for headers
        $png = url('') . "/storage/photos/1/Untitled.png";
        $filesize = filesize('storage/photos/1/Untitled.png');

        //Set header and content
        header("Content-Type: image/png");
        $sign = imagecreatefrompng("storage/photos/1/Untitled.png");

        return redirect()->to($png);
        //readfile($png);
        //Now actually output the image requested, while disregarding if the database was affected
        /*header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private', false);
        header('Content-Disposition: attachment; filename="blank.gif"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . $filesize);
        readfile($png);*/
        //return redirect('storage/photos/1/images.jpg');
    }

    function tidy($str)
    { //remove quotes and backslashes from string
        if (is_null($str) || ($str == "")) {
            return "null";
        }
        $str = trim(str_replace('\\', '', str_replace("'", "", str_replace('"', "", $str))));
        if (is_numeric($str)) {
            return $str;
        }
        return "'$str'";
    }
}
