<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use App\LogActivityUser as LogActivityUserModel;
use Auth;


class LogActivityUser
{
    //
    public static function addToLog($subject,$aksi=0){
        $log = [];
        $log['subject'] = $subject;
        $log['url'] = request()->fullUrl();
        $log['method'] = request()->method();
        $log['ip'] = request()->ip();
        $log['agent'] = request()->header('user-agent');
        $log['user_id'] = Auth::user()->id;
        $log['aksi'] = $aksi;
        LogActivityUserModel::create($log);
    }

    public static function logActivityList()
    {
        # code...
        return LogActivityUserModel::latest()->get();
    }
}
