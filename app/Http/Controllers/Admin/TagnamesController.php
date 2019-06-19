<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class TagnamesController extends Controller
{
    //
    public function index()
    {
    	// 获取数据库所有信息
    	$data = DB::table('tagnames')->orderBy('id','asc')->get();

    	return view('admin.tagnames.index',['data'=>$data]);
    }

    public function create()
    {
    	return view('admin.tagnames.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
	        'tagname' => 'required',
	        'bgcolor' => 'required',
	    ],[
	    	'tagname.required'=>'标签云必填',
	    	'bgcolor.required'=>'请选择颜色',
	    ]);

    	// dump($request->all());
    	$data = $request->except('_token');
    	$res = DB::table('tagnames')->insert($data);
    	if ($res) {
    		return redirect('admins/tagnames/index')->with('success','添加成功');
    	} else {
    		return back()->with('error','添加失败');
    	}
    }

    // 执行删除
    public function destroy(Request $request)
    {
        $id =  $request->input('id',0);

        // 获取数据库token 
        // $data_token = DB::table('tagnames')->select('token')->where('id',$id)->first();
        // dd($data_token->token);
        
        // 验证token
        // if ($data_token->token != $token) {
        //     // echo 'err';
        //     exit('err');
        // }

        // 删除
        $res = DB::table('tagnames')->where('id',$id)->delete();
        
        if($res){
            echo "ok";
        }else{
            echo "err";
        }
    }
}
