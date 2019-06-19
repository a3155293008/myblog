<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class IndexController extends Controller
{
    public function login()
    {
    	// echo '后台首页';
    	// 加载html
    	return view('admin.index.login');
    }

    public function dologin(Request $request)
    {
    	// dump($request->all());
    	
    	$uname = $request->input('uname','');
    	$upass = $request->input('upass',''); 

    	$data = DB::table('users')->where('uname',$uname)->first();
    	if (empty($data)) {
    		return back()->with('error','用户名或密码错误');
    	} 
    	// dump($data);
    	
    	// 验证密码
    	if (!Hash::check($upass, $data->upass)) {
		    return back()->with('error','用户名或密码错误');
		}

        // 检测权限
        // dd($data);
        if ($data->type != 1) {
            return back()->with('error','没有权限');
        }


		// 登录
		session(['admin_login'=>true]);
		session(['admin_userinfo'=>$data]);

		// 跳转
		return redirect('/admins/users/index');
    }

    public function logout()
    {
    	session(['admin_login'=>null]);
		session(['admin_userinfo'=>null]);
		return back();
    }
}
