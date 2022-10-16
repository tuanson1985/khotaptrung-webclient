<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Log;

class GitPullController extends Controller
{
    public function getGitPull(Request $request){

        $token = $request->token;

        if (!$token){
            return response()->json([
                'message' => __('Token không hợp lệ'),
                'status' => 0,
            ], 200);
        }

        $brand = $request->brand;

        if (!$brand){
            return response()->json([
                'message' => __('Nhánh không hợp lệ'),
                'status' => 0,
            ], 200);
        }

        $command ='git pull https://'.$token.'@github.com/tannm2611/khotaptrung-webclient.git '.$brand.' 2>&1';

        $output = shell_exec($command);

        \Artisan::call('cache:clear');
        \Artisan::call('config:cache');
        \Artisan::call('view:clear');
        \Artisan::call('route:clear');
        Cache::flush();

        return response()->json([
            'status' => 1,
            'message' => 'Thành công!',
            'data' => $output,
        ]);
    }
}
