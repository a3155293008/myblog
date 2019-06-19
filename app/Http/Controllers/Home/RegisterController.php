<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\Register; 
use Captcha;
class RegisterController extends Controller
{
    // 显示注册页面
    public function index()
    {
    	return view('home.register.index');
    }

    public function store(Request $request)
    {
    	// 验证 验证码
     	//if($request->captcha){
		// 	$this->validate($request, [
		// 		'code' => 'required|captcha',
		// 	]);
		// }
    	if (!Captcha::check($request->input('code'))) {
    		// return back()->with('error','验证码错误');
    		echo json_encode(['msg'=>'err','info'=>'验证码错误']);
    		exit;
    	} else {
    		echo json_encode(['msg'=>'ok','info'=>'注册成功']);
    	}

    }
}
