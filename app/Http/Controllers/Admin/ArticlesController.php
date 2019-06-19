<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
class ArticlesController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search','');
        // dd($search);
    	$data = DB::table('articles')->where('title','like','%'.$search.'%')->orderBy('id','asc')->paginate(3);

    	return view('admin.articles.index',['data'=>$data,'search'=>$search]);
    }

    public function create()
    {
    	// 获取标签云数据
    	$tagnames_data = DB::table('tagnames')->get();

    	// 获取栏目数据
    	$cates_data = CatesController::getCates();

    	return view('admin.articles.create',['tagnames_data'=>$tagnames_data,'cates_data'=>$cates_data]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'content' => 'required',
        ],[
            'content.required'=>'内容必填',
            'title.required'=>'标题必填',
            'title.max'=>'标题过大',
        ]);

    	// dump($request->all());
    	if ($request->hasFile('thumb')) {
    		$thumb = $request->file('thumb')->store(date('Ymd'));
    	} else {
    		return back()->with('error','请选择图片');
    	}
    	// 获取数据
    	$data = $request->except(['_token','thumb']);
    	$data['ctime'] = date('Y-m-d H:i:s',time());
    	$data['thumb'] = $thumb;
    	$data['num'] = rand(1500,4000);
    	$data['goodnum'] = rand(500,1000);

    	// 执行添加
    	$res = DB::table('articles')->where('id','asc')->insert($data);
    	if ($res) {
    		return redirect('admins/articles/index')->with('success','添加成功');
    	} else {
    		return back()->with('error','添加失败');
    	}
    }

    // 执行删除
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
        $res = DB::table('articles')->where('id',$id)->delete();
        
        if($res){
            echo "ok";
        }else{
            echo "err";
        }
    }

     // 用户修改
    public function edit($id)
    {
        // 获取当前要修改的数据
        $data = DB::table('articles')->where('id',$id)->first();
        // dd($data);
        
        // 验证
        // if ($data->token != $token) {
        //     return back()->with('error','token验证失败');
        // }

        // 显示页面 显示要修改的数据
        return view('admin.articles.edit',['data'=>$data]);
    }  

    public function update(Request $request,$id)
    {
        // 验证数据
        $this->validate($request, [
            'title' => 'required',
            'auth' => 'required',
        ],[
            'title.required'=>'标题必填',
            'auth.required'=>'作者必填',
        ]);

        // 执行文件上传
        if ($request->hasFile('thumb')) {
            // 删除 旧的图片
            Storage::delete($request->input('thumb_path'));

            // 上传 新的图片
            $path = $request->file('thumb')->store(date('Ymd'));
        } else {
            $path = $request->input('thumb_path');
        }

        // 接收用户提交的值
        $data['title'] = $request->input('title','');
        $data['auth'] = $request->input('auth','');
        $data['thumb'] = $path;
        $data['desc'] = $request->input('desc','');
        // 修改 随机 token
        // $data['token'] = str_random(50);

        // 执行修改
        $res = DB::table('articles')->where('id',$id)->update($data);

        // 判断逻辑
        if ($res) {
            return redirect('admins/articles/index')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }
    } 
}
