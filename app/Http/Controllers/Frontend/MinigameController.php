<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Library\DirectAPI;
use Illuminate\Http\Request;
use Cache;
use Session;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class MinigameController extends Controller
{
    public function getIndex(Request $request){
        Session::forget('return_url');
        Session::put('return_url', $_SERVER['REQUEST_URI']);
        try{
            $method = "GET";
            $data = array();
            $data['token'] = Session::get('jwt');
            $data['secret_key'] = config('api.secret_key');
            $data['domain'] = \Request::server("HTTP_HOST");

            // $group_api = Cache::get('minigame_list');
            // if(!isset($group_api)){
                $url = '/minigame/get-list-minigame';
                $group_api = DirectAPI::_makeRequest($url,$data,$method);
                if (isset($group_api) && $group_api->response_code == 200 ) {
                    $group_api = $group_api->response_data->data;
                }

            $groups = array_filter($group_api, function ($value) use ($request){
                return $value->slug== $request->slug;
            });
            $groups_other = array_filter($group_api, function ($value) use ($request){
                return $value->slug != $request->slug;
            });
            $group=null;
            foreach ($groups as $dataar) {
                $group = $dataar;
            }
            $url = '/minigame/get-minigame-info';
            $data['id'] = $group->id;
            $data['module'] = explode('-', $group->module)[0];
            $result_Api = DirectAPI::_makeRequest($url,$data,$method);

            if (isset($result_Api) && $result_Api->response_code == 200 ) {
                $result_out = $result_Api->response_data;
                if ($result_out->status == 1) {
                    $result = $result_out->data;

                    //tạo dữ liệu seeding
                    //Tạo random đang chơi:
                    if($group->params->user_num_from > 0 && $group->params->user_num_to > 0 && $group->params->user_num_from < $group->params->user_num_to){
                        $numPlay = rand($group->params->user_num_from, $group->params->user_num_to);
                    }else{
                        $numPlay = rand(1,1000);
                    }

                    //top quay thuong
                    $firstname = ['James','Robert','John','Michael','William','David','Richard','Joseph','Thomas','Charles','Christopher','Daniel','Matthew','Anthony','Mark','Donald','Steven','Paul','Andrew','Joshua','Kenneth','Kevin','Brian','George','Edward','Ronald','Timothy','Jason','Jeffrey','Ryan','Jacob','Gary','Nicholas','Eric','Jonathan','Stephen','Larry','Justin','Scott','Brandon','Benjamin','Samuel','Gregory','Frank','Alexander','Raymond','Patrick','Jack','Dennis','Jerry','Tyler','Aaron','Jose','Adam','Henry','Nathan','Douglas','Zachary','Peter','Kyle','Walter','Ethan','Jeremy','Harold','Keith','Christian','Roger','Noah','Gerald','Carl','Terry','Sean','Austin','Arthur','Lawrence','Jesse','Dylan','Bryan','Joe','Jordan','Billy','Bruce','Albert','Willie','Gabriel','Logan','Alan','Juan','Wayne','Roy','Ralph','Randy','Eugene','Vincent','Russell','Elijah','Louis','Bobby','Philip','Johnny','Mary','Patricia','Jennifer','Linda','Elizabeth','Barbara','Susan','Jessica','Sarah','Karen','Nancy','Lisa','Betty','Margaret','Sandra','Ashley','Kimberly','Emily','Donna','Michelle','Dorothy','Carol','Amanda','Melissa','Deborah','Stephanie','Rebecca','Sharon','Laura','Cynthia'];
                    $lastname = ['Johnathon','Anthony','Erasmo','Raleigh','Nancie','Tama','Camellia','Augustine','Christeen','Luz','Diego','Lyndia','Thomas','Georgianna','Leigha','Alejandro','Marquis','Joan','Stephania','Elroy','Zonia','Buffy','Sharie','Blythe','Gaylene','Elida','Randy','Margarete','Margarett','Dion','Tomi','Arden','Clora','Laine','Becki','Margherita','Bong','Jeanice','Qiana','Lawanda','Rebecka','Maribel','Tami','Yuri','Michele','Rubi','Larisa','Lloyd','Tyisha','Samatha','Mischke','Serna','Pingree','Mcnaught','Pepper','Schildgen','Mongold','Wrona','Geddes','Lanz','Fetzer','Schroeder','Block','Mayoral','Fleishman','Roberie','Latson','Lupo','Motsinger','Drews','Coby','Redner','Culton','Howe','Stoval','Michaud','Mote','Menjivar','Wiers','Paris','Grisby','Noren','Damron','Kazmierczak','Haslett','Guillemette','Buresh','Center','Kucera','Catt','Badon','Grumbles','Antes','Byron','Volkman','Klemp','Pekar','Pecora','Schewe','Ramage'];
                    $numTop = 30;
                    if($group->params->acc_show_num > 0){
                        $numTop = $group->params->acc_show_num;
                    }

                    $topDayList = Cache::get('topDayList'.$group->id);
                    if($topDayList==null){
                        $topDayList = array();
                        for($i=0;$i<=$numTop;$i++){
                            $fname = $firstname[rand(0,count($firstname)-1)];
                            $lname = $lastname[rand(0 ,count($lastname)-1)];
                            $name = substr($fname, 0,rand(2,3));
                            $name .= '*****';
                            $name .= substr($lname,(strlen($lname)-rand(2,3)),strlen($lname));
                            if($group->params->play_num_from > 0 && $group->params->play_num_to > 0 && $group->params->play_num_from < $group->params->play_num_to){
                                $num = rand($group->params->user_num_from, $group->params->play_num_to);
                            }else{
                                $num = rand(1,1000);
                            }
                            $topDay = [
                                'name' => $name,
                                'numwheel' => $num
                            ];
                            array_push($topDayList, $topDay);
                        }
                        array_multisort(array_column($topDayList, 'numwheel'), SORT_DESC, SORT_NATURAL|SORT_FLAG_CASE, $topDayList);
                        $expiresAt = Carbon::now()->addHours(24);
                        Cache::put('topDayList'.$group->id, $topDayList, $expiresAt);
                    }

                    $top7DayList = Cache::get('top7DayList'.$group->id);
                    if($top7DayList==null){
                        $top7DayList = array();
                        for($i=1;$i<$numTop;$i++){
                            $fname = $firstname[rand(0,count($firstname)-1)];
                            $lname = $lastname[rand(0 ,count($lastname)-1)];
                            $name = substr($fname, 0,rand(2,3));
                            $name .= '*****';
                            $name .= substr($lname,(strlen($lname)-rand(2,3)),strlen($lname));
                            if($group->params->play_num_from > 0 && $group->params->play_num_to > 0 && $group->params->play_num_from < $group->params->play_num_to){
                                $num = rand($group->params->user_num_from*7, $group->params->play_num_to*7);
                            }else{
                                $num = rand(1,7000);
                            }
                            $topDay = [
                                'name' => $name,
                                'numwheel' => $num
                            ];
                            array_push($top7DayList, $topDay);
                        }
                        array_multisort(array_column($top7DayList, 'numwheel'), SORT_DESC, SORT_NATURAL|SORT_FLAG_CASE, $top7DayList);
                        $expiresAt = Carbon::now()->addHours(24*7);
                        Cache::put('top7DayList'.$group->id, $top7DayList, $expiresAt);
                    }

                    $numNear = 10;
                    $numNearSpecial = 10;
                    if($group->params->play_num_near > 0){
                        $numNear = $group->params->play_num_near;
                    }
                    if($group->params->special_num_from > 0 && $group->params->special_num_to > 0 && $group->params->special_num_from < $group->params->special_num_to){
                        $numNearSpecial = rand($group->params->special_num_from, $group->params->special_num_to);
                    }
                    $currentPlayList = "";
                    if(count($result->group->items)>0){
                        $currentPlayList = Cache::get('currentPlayList'.$group->id);
                        if($currentPlayList==null){
                            $arrayGift = [];
                            $arrayGiftSpecial = [];
                            foreach ($result->group->items as $key) {
                                if(isset($key->params->special) && $key->params->special == 1){
                                    array_push($arrayGiftSpecial, $key->title);
                                }else{
                                    array_push($arrayGift, $key->title);
                                }
                            }

                            if(count($arrayGiftSpecial) > 0){
                                for($i=0;$i<=$numNearSpecial;$i++){
                                    $fname = $firstname[rand(0,count($firstname)-1)];
                                    $lname = $lastname[rand(0 ,count($lastname)-1)];
                                    $name = substr($fname, 0,rand(2,3));
                                    $name .= '*****';
                                    $name .= substr($lname,(strlen($lname)-rand(2,3)),strlen($lname));
                                    $gift = $arrayGiftSpecial[rand(0,count($arrayGiftSpecial)-1)];
                                    $currentPlayList = $currentPlayList.'&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #28a745"><i class="menu-icon fas fa-user"></i>&nbsp;&nbsp;'.$name.'</span> - đã trúng '.$gift;
                                }
                            }

                            if(count($arrayGift) > 0){
                                for($i=0;$i<=$numNear;$i++){
                                    $fname = $firstname[rand(0,count($firstname)-1)];
                                    $lname = $lastname[rand(0 ,count($lastname)-1)];
                                    $name = substr($fname, 0,rand(2,3));
                                    $name .= '*****';
                                    $name .= substr($lname,(strlen($lname)-rand(2,3)),strlen($lname));
                                    $gift = $arrayGift[rand(0,count($arrayGift)-1)];
                                    $currentPlayList = $currentPlayList.'&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #28a745"><i class="menu-icon fas fa-user"></i>&nbsp;&nbsp;'.$name.'</span> - đã trúng '.$gift;
                                }
                            }
                            $currentPlayList = $currentPlayList!=""?("Danh sách trúng thưởng: ".$currentPlayList):"";

                            $expiresAt = Carbon::now()->addMinutes(5);
                            Cache::put('currentPlayList'.$group->id, $currentPlayList, $expiresAt);
                        }
                    }

                    switch ($result->group->position) {
                        case 'rubywheel':
                            return view('frontend.pages.minigame.rubywheel', compact('result','groups_other','numPlay','topDayList','top7DayList','currentPlayList'));
                        case 'flip':
                            return view('frontend.pages.minigame.flip', compact('result','groups_other','numPlay','topDayList','top7DayList','currentPlayList'));
                        case 'slotmachine':
                            return view('frontend.pages.minigame.slotmachine', compact('result','groups_other','numPlay','topDayList','top7DayList','currentPlayList'));
                        case 'slotmachine5':
                            return view('frontend.pages.minigame.slotmachine5', compact('result','groups_other','numPlay','topDayList','top7DayList','currentPlayList'));
                        case 'squarewheel':
                            return view('frontend.pages.minigame.squarewheel', compact('result','groups_other','numPlay','topDayList','top7DayList','currentPlayList'));
                        case 'smashwheel':
                            return view('frontend.pages.minigame.smashwheel', compact('result','groups_other','numPlay','topDayList','top7DayList','currentPlayList'));
                        case 'rungcay':
                            return view('frontend.pages.minigame.smashwheel', compact('result','groups_other','numPlay','topDayList','top7DayList','currentPlayList'));
                        case 'gieoque':
                            return view('frontend.pages.minigame.smashwheel', compact('result','groups_other','numPlay','topDayList','top7DayList','currentPlayList'));
                        default:
                            return redirect()->back()->withErrors($result_out->message);
                    }
                } else {
                    logger('minigame: '.$result_Api->response_data->msg);
                    return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
                }
            } else {
                logger('minigame: '.$result_Api->response_data->msg);
                return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
            }
        }
        catch(\Exception $e){
            logger($e);
            return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
        }
    }

    public function postRoll(Request $request){
        if ($request->ajax()){
            if(empty(Session::get('jwt'))){
                return response()->json([
                    'status' => 4,
                    'msg'=> 'Vui lòng đăng nhập !'
                ], 200);
            }
            try{
                $msg = "";
                $status = 0;

                $method = "POST";
                $data = array();
                $data['token'] = Session::get('jwt');
                $data['secret_key'] = config('api.secret_key');
                $data['domain'] = \Request::server("HTTP_HOST");
                $data['id'] = $request->id;
                $data['numrollbyorder'] = $request->numrollbyorder;
                $data['typeRoll'] = $request->typeRoll;
                $data['numrolllop'] = $request->numrolllop;
                $data['id'] = $request->id;

                $url = '/minigame/post-minigame';
                $result_Api = DirectAPI::_makeRequest($url,$data,$method);
                if (isset($result_Api) && $result_Api->response_code == 200 ) {
                    $result = $result_Api->response_data;
                    if ($result->status == 1) {
                        return response()->json([
                            'free_wheel'=> $result->free_wheel,
                            'arr_gift' => $result->arr_gift,
                            'gift_detail' => $result->gift_detail,
                            'xgt' => $result->xgt,
                            'xValue' => $result->xValue,
                            'numrollbyorder' => $result->numrollbyorder,
                            'value_gif_bonus' => $result->value_gif_bonus,
                            'msg_random_bonus' => $result->msg_random_bonus,
                            'userpoint' => $result->userpoint,
                            'listgift' => $result->listgift,
                            'status' => 1,
                            'msg'=> $result->msg
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => $result->status,
                            'msg'=> $result->msg
                        ], 200);
                    }
                } else {
                    if($result_Api->response_code==401){
                        return response()->json([
                            'status' => 4,
                            'msg'=> 'Vui lòng đăng nhập lại.'
                        ], 200);
                    }else{
                        return response()->json([
                            'status' => 0,
                            'msg'=> 'Có lỗi phát sinh.Xin vui lòng thử lại!'
                        ], 200);
                    }
                }
            }
            catch(\Exception $e){
                logger($e);
                return response()->json([
                    'status' => 0,
                    'msg'=> 'Có lỗi phát sinh.Xin vui lòng thử lại!.'
                ], 200);
            }
        }
    }

    public function postBonus(Request $request){
        if ($request->ajax()){
            if(empty(Session::get('jwt'))){
                return response()->json([
                    'status' => 4,
                    'msg'=> 'Vui lòng đăng nhập !'
                ], 200);
            }
            try{
                $msg = "";
                $status = 0;

                $method = "POST";
                $data = array();
                $data['token'] = Session::get('jwt');;
                $data['secret_key'] = config('api.secret_key');
                $data['domain'] = \Request::server("HTTP_HOST");
                $data['id'] = $request->id;
                $data['numrollbyorder'] = $request->numrollbyorder;

                $url = '/minigame/post-minigamebonus';
                $result_Api = DirectAPI::_makeRequest($url,$data,$method);
                if (isset($result_Api) && $result_Api->response_code == 200 ) {
                    $result = $result_Api->response_data;
                    if ($result->status == 1) {
                        return response()->json([
                            'free_wheel'=> $result->free_wheel,
                            'arr_gift' => $result->arr_gift,
                            'gift_detail' => $result->gift_detail,
                            'xgt' => $result->xgt,
                            'xValue' => $result->xValue,
                            'value_gif_bonus' => $result->value_gif_bonus,
                            'msg_random_bonus' => $result->msg_random_bonus,
                            'userpoint' => $result->userpoint,
                            'listgift' => $result->listgift,
                            'status' => 1,
                            'msg'=> $result->msg
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => $result->status,
                            'msg'=> $result->msg
                        ], 200);
                    }
                } else {
                    if($result_Api->response_code==401){
                        return response()->json([
                            'status' => 4,
                            'msg'=> 'Vui lòng đăng nhập lại.'
                        ], 200);
                    }else{
                        return response()->json([
                            'status' => 0,
                            'msg'=> 'Có lỗi phát sinh.Xin vui lòng thử lại !'
                        ], 200);
                    }
                }
            }
            catch(\Exception $e){
                logger($e);
                return response()->json([
                    'status' => 0,
                    'msg'=> 'Có lỗi phát sinh.Xin vui lòng thử lại !'
                ], 200);
            }
        }
    }

    public function getLog(Request $request){
        if(!empty(Session::get('jwt'))){
            try{
                $method = "GET";
                $data = array();
                $data['token'] = Session::get('jwt');;
                $data['secret_key'] = config('api.secret_key');
                $data['domain'] = \Request::server("HTTP_HOST");

                // $group_api = Cache::get('minigame_list');
                // if(!isset($group_api)){
                    $url = '/minigame/get-list-minigame';
                    $group_api = DirectAPI::_makeRequest($url,$data,$method);
                    if (isset($group_api) && $group_api->response_code == 200 ) {
                        $group_api = $group_api->response_data->data;
                    }
                //     try{
                //         Cache::put('minigame_list', $group_api, now()->addMinutes(5));
                //     }catch(Exception $e){
                //         logger($e);
                //     }
                // }
                $groups = array_filter($group_api, function ($value) use ($request){
                    return $value->id== $request->id;
                });
                $group=null;
                foreach ($groups as $dataar) {
                    $group = $dataar;
                }
                $url = '/minigame/get-log';
                $data['id'] = $group->id;
                $data['module'] = explode('-', $group->module)[0];
                $data['page'] = $request->page==""?"1":$request->page;

                if ($request->filled('gift_name')) {
                    $data['gift_name'] = $request->get('gift_name');
                }
                if ($request->filled('started_at')) {
                    $data['started_at'] = $request->get('started_at');
                }
                if ($request->filled('ended_at')) {
                    $data['ended_at'] = $request->get('ended_at');
                }

                $result_Api = DirectAPI::_makeRequest($url,$data,$method);
                if (isset($result_Api) && $result_Api->response_code == 200 ) {
                    $result = $result_Api->response_data;
                    if (isset($result->status) && $result->status == 0) {
                        return redirect()->back()->withErrors($result_out->msg);
                    } else {
                        $perPage = $result->per_page??0;
                        $total = $result->total??0;
                        $paginatedItems = new LengthAwarePaginator("" , $total, $perPage);
                        $paginatedItems->setPath($request->url());
                        return view('frontend.pages.minigame.log', compact('paginatedItems','result','group','group_api'));
                    }
                } else {
                    logger('minigame: '.$result_Api->response_data->msg);
                    return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
                }
            }
            catch(\Exception $e){
                logger($e);
                return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
            }
        }else{
            return redirect('login');
        }
    }

    public function getLogAcc(Request $request){
        if(!empty(Session::get('jwt'))){
            try{
                $method = "GET";
                $data = array();
                $data['token'] = Session::get('jwt');;
                $data['secret_key'] = config('api.secret_key');
                $data['domain'] = \Request::server("HTTP_HOST");

                // $group_api = Cache::get('minigame_list');
                // if(!isset($group_api)){
                    $url = '/minigame/get-list-minigame';
                    $group_api = DirectAPI::_makeRequest($url,$data,$method);
                    if (isset($group_api) && $group_api->response_code == 200 ) {
                        $group_api = $group_api->response_data->data;
                    }
                //     try{
                //         Cache::put('minigame_list', $group_api, now()->addMinutes(5));
                //     }catch(Exception $e){
                //         logger($e);
                //     }
                // }
                $groups = array_filter($group_api, function ($value) use ($request){
                    return $value->id== $request->id;
                });
                $group=null;
                foreach ($groups as $dataar) {
                    $group = $dataar;
                }
                $url = '/minigame/get-logacc';
                $data['id'] = $group->id;
                $data['module'] = explode('-', $group->module)[0];
                $data['page'] = $request->page==""?"1":$request->page;

                if ($request->filled('gift_name')) {
                    $data['gift_name'] = $request->get('gift_name');
                }
                if ($request->filled('started_at')) {
                    $data['started_at'] = $request->get('started_at');
                }
                if ($request->filled('ended_at')) {
                    $data['ended_at'] = $request->get('ended_at');
                }
                $result_Api = DirectAPI::_makeRequest($url,$data,$method);
                if (isset($result_Api) && $result_Api->response_code == 200 ) {
                    $result = $result_Api->response_data;
                    if (isset($result->status) && $result->status == 0) {
                        return redirect()->back()->withErrors($result->msg);
                    } else {
                        $perPage = $result->per_page??0;
                        $total = $result->total??0;
                        $paginatedItems = new LengthAwarePaginator("" , $total, $perPage);
                        $paginatedItems->setPath($request->url());
                        return view('frontend.pages.minigame.logacc', compact('paginatedItems','result','group','group_api'));
                    }
                } else {
                    logger('minigame: '.$result_Api->response_data->msg);
                    return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
                }
            }
            catch(\Exception $e){
                logger($e);
                return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
            }
        }else{
            return redirect('login');
        }
    }

    public function getWithdrawItem(Request $request){
        if(!empty(Session::get('jwt'))){
            try{
                $game_type = $request->game_type;
                $method = "GET";
                $data = array();
                $data['token'] = Session::get('jwt');;
                $data['secret_key'] = config('api.secret_key');
                $data['domain'] = \Request::server("HTTP_HOST");
                $url = '/minigame/get-withdraw-item';
                $data['page'] = $request->page;
                $data['game_type'] = $game_type;
                $result_Api = DirectAPI::_makeRequest($url,$data,$method);
                if (isset($result_Api) && $result_Api->response_code == 200 ) {
                    $result = $result_Api->response_data;
                    if (isset($result->status) && $result->status == 4) {
                        return redirect('login');
                    } else {
                        $paginatedItems = null;
                        if($result->withdraw_history->total>0){
                            $perPage = $result->withdraw_history->per_page??0;
                            $total = $result->withdraw_history->total??0;
                            $paginatedItems = new LengthAwarePaginator("" , $total, $perPage);
                            $paginatedItems->setPath($request->url());
                        }
                        return view('frontend.pages.minigame.withdrawitem', compact('paginatedItems','result','game_type'));
                    }
                } else {
                    logger('withdrawitem: '.$result_Api->response_data->msg);
                    return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
                }
            }
            catch(\Exception $e){
                logger($e);
                return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
            }
        }else{
            return redirect('login');
        }
    }

    public function postWithdrawItemAjax(Request $request){
        try{
            if(empty(Session::get('jwt'))){
                return response()->json([
                    'status' => 4,
                    'msg'=> 'Vui lòng đăng nhập !'
                ], 200);
            }
            $game_type = $request->game_type;
            $method = "GET";
            $data = array();
            $data['token'] = Session::get('jwt');;
            $data['secret_key'] = config('api.secret_key');
            $data['domain'] = \Request::server("HTTP_HOST");
            $url = '/minigame/get-withdraw-item';
            $data['page'] = $request->page;
            $data['game_type'] = $game_type;
            $result_Api = DirectAPI::_makeRequest($url,$data,$method);
            if (isset($result_Api) && $result_Api->response_code == 200 ) {
                $result = $result_Api->response_data;
                if (isset($result->status) && $result->status == 4) {
                    return response()->json([
                        'status' => 4,
                        'msg'=> 'Vui lòng đăng nhập !'
                    ], 200);
                } else {
                    $paginatedItems = null;
                    if($result->withdraw_history->total>0){
                        $perPage = $result->withdraw_history->per_page??0;
                        $total = $result->withdraw_history->total??0;
                        $paginatedItems = new LengthAwarePaginator("" , $total, $perPage);
                        $paginatedItems->setPath($request->url());
                    }

                    return response()->json([
                        'status' => $result->status,
                        'msg'=> view('frontend.pages.minigame.withdrawitemajax', compact('paginatedItems','result','game_type'))->render()
                    ], 200);
                }
            } else {
                return response()->json([
                    'status' => 0,
                    'msg'=> 'Có lỗi phát sinh.Xin vui lòng thử lại !'
                ], 200);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 0,
                'msg'=> 'Có lỗi phát sinh.Xin vui lòng thử lại !'
            ], 200);
        }
    }

    public function postWithdrawItem(Request $request){
        if(!empty(Session::get('jwt'))){
            $this->validate($request, [
                'idgame' => 'required',
                'package' => 'required'

            ], [
                'idgame.required' => "Vui lòng nhập ID trong game để rút tiền",
                'package.required' => "Vui lòng chọn gói muốn rút"

            ]);
            try{
                $game_type = $request->game_type;
                $method = "POST";
                $data = array();
                $data['token'] = Session::get('jwt');;
                $data['secret_key'] = config('api.secret_key');
                $data['domain'] = \Request::server("HTTP_HOST");
                $url = '/minigame/post-withdraw-item';
                $data['type'] = $game_type;
                $data['package'] = $request->package;
                $data['idgame'] = $request->idgame;
                $data['phone'] = $request->phone;
                $result_Api = DirectAPI::_makeRequest($url,$data,$method);
                if (isset($result_Api) && $result_Api->response_code == 200 ) {
                    $result = $result_Api->response_data;
                    if (isset($result->status) && $result->status == 4) {
                        return redirect('login');
                    }else if(isset($result->status) && $result->status == 0){
                        return redirect()->back()->withErrors($result->msg);
                    }else {
                        return redirect()->back()->with('success',$result->msg);
                    }
                } else {
                    logger('withdrawitem: '.$result_Api->response_data->msg);
                    return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
                }
            }
            catch(\Exception $e){
                logger($e);
                return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
            }
        }else{
            return redirect('login');
        }
    }

}
