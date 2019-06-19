<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class LoginController extends Controller
{
    // 显示 前台 登录 模板
    public function login()
    {
    	return view('home.login.login');
    }

    public function dologin(Request $request)
    {
    	$uname = $request->input('uname','');
    	$upass = $request->input('upass',''); 

    	$data = DB::table('users')->where('uname',$uname)->first();
    	if (empty($data)) {
    		// return back()->with('error','用户名或密码错误');
    		echo json_encode(['msg'=>'err','info'=>'用户名或密码错误']);
    		exit;
    	} 
    	// dump($data);
    	
    	// 验证密码
    	if (!Hash::check($upass, $data->upass)) {
		    // return back()->with('error','用户名或密码错误');
		    echo json_encode(['msg'=>'err','info'=>'用户名或密码错误']);
    		exit;
		}

        // 检测权限
        // dd($data);
        // if ($data->type != 1) {
        //     return back()->with('error','没有权限');
        // }


		// 登录
		session(['home_login'=>true]);
		session(['home_userinfo'=>$data]);

		// 跳转
		// return redirect('/admins/users/index');
		echo json_encode(['msg'=>'ok','info'=>'登路成功']);
    }

    public function logout()
    {
    	session(['home_login'=>false]);
		session(['home_userinfo'=>false]);
		return back();
    }
}
