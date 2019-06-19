<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;

class BannersController extends Controller
{
    //
    public function index()
    {
    	$data = DB::table('banners')->get();
    	// dd($data);

    	return view('admin.banners.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.banners.create');
    }

    public function store(Request $request)
    {
    	if ($request->hasFile('url')) {
    		$url = $request->file('url')->store(date('Ymd'));
    	} else {
    		return back()->with('error','请选择图片');
    	}

    	// 接收数据
    	$data['title'] = $request->input('title','');
    	$data['desc'] = $request->input('desc','');
    	$data['url'] = $url;
    	$data['status'] = $request->input('status','');

    	// 执行 添加到数据库
    	$res = DB::table('banners')->insert($data);
    	if ($res) {
    		return redirect('admins/banners/index')->with('success','添加成功');
    	} else {
    		return back()->with('error','添加失败');
    	}

    }

    public function destroy(Request $request)
    {
        $id =  $request->input('id',0);
        // $token =  $request->input('token',0);

        // 获取数据库token 
        // $data_token = DB::table('users')->select('token')->where('id',$id)->first();
        // dd($data_token->token);
        
        // 验证token
        // if ($data_token->token != $token) {
        //     // echo 'err';
        //     exit('err');
        // }

        // 删除
        $res = DB::table('banners')->where('id',$id)->delete();
        
        if($res){
            echo "ok";
        }else{
            echo "err";
        }
    }

    public function edit($id)
    {
        $data = DB::table('banners')->where('id',$id)->first();

        // dd($data);

        return view('admin/banners/edit',['data'=>$data]);
    }

    public function update(Request $request,$id)
    {
        // 验证数据
        $this->validate($request, [
            'title' => 'required',
            'desc' => 'required',
        ],[
            'title.required'=>'标题必填',
            'desc.required'=>'描述必填',
        ]);

        // 执行文件上传
        if ($request->hasFile('url')) {
            // 删除 旧的图片
            Storage::delete($request->input('url_path'));

            // 上传 新的图片
            $path = $request->file('url')->store(date('Ymd'));
        } else {
            $path = $request->input('url_path');
        }

        // 接收用户提交的值
        $data['title'] = $request->input('title','');
        $data['desc'] = $request->input('desc','');
        $data['url'] = $path;
        $data['status']= $request->input('status','');
        // $data['token'] = str_random(50);
        // dd($data);
        // 执行修改
        // dd($id);
        $res = DB::table('banners')->where('id',$id)->update($data);
        // dd($res);
        // 判断逻辑
        if ($res) {
            return redirect('admins/banners/index')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }
    
    }



    public function changeStatus(Request $request)
    {
    	$status = $request->input('status');
    	// dump($status);
    	
    	$id = $request->input('id');

    	// 执行修改
    	$res = DB::table('banners')->where('id',$id)->update(['status'=>$status]);

    	if ($res) {
    		return back()->with('success','修改成功');
    	} else {
    		return back()->with('error','修改失败');
    	}
    }
}
