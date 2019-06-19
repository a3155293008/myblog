<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CatesController extends Controller
{
	public static function getCates()
	{
		// 获取数据
		// $data = DB::table('cates')->get();
    	// $data = DB::select('select *,concat(path,",",id) as paths from cates order by paths asc');
    	$data = DB::table('cates')->select('*',DB::raw('concat(path,",",id) as paths'))->orderBy('paths','asc')->get();
    	// dump($data);
    	foreach($data as $k=>$v){
    		if ($v->pid != 0) {
    			$data[$k]->cname = '|-----'.$v->cname;
    		}
    	}
    	return $data;
	}
    // 列表
    public function index()
    {


    	// 显示数据
    	return view('admin.cates.index',['data'=>self::getCates()]);
    }

    // 添加
    public function create(Request $request)
    {
    	$id = $request->input('id',0);
    	// dump($id);

    	// 获取所有的栏目,数据库里的所有,然后进行分配
    	// $cates_data = DB::table('cates')->get();
    	// 显示页面
    	return view('admin.cates.create',['id'=>$id,'cates_data'=>self::getCates()]);
    }

    public function store(Request $request)
    {
    	// dump($request->all());
    	// 获取pid
    	$pid = $request->input('pid');

    	if ($pid == 0) {
    		$path = 0;
    	} else {
    		// 获取父级数据
    		$parent_data = DB::table('cates')->where('id',$pid)->first();
    		$path = $parent_data->path.','.$parent_data->id;
    	}

    	$data['pid'] = $pid;
    	$data['cname'] = $request->input('cname','');
    	$data['path'] = $path;

    	// 将数据压入到数据库
    	$res = DB::table('cates')->insert($data);
    	if ($res) {
    		return redirect('admins/cates/index')->with('success','添加成功');
    	} else {
    		return back()->with('error','添加失败');
    	}
    }
}
