<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
    // 封装 右侧边栏
    public static function getrightcatesa()
    {
         // 右侧边栏 显示两条 
        $articles_prev_data = DB::table('articles')->orderBy('ctime','asc')->skip(0)->take(2)->get();
        // dd($articles_data);
        return $articles_prev_data;
    }   

    public static function getrightcatesb()
    {
        // 右侧边栏 特别推荐
        $articles_tuijian_data = DB::table('articles')->orderBy('num','desc')->skip(0)->take(3)->get();
        // dd($articles_tuijian_data);
        return $articles_tuijian_data;
    }   

    public static function getrightcatesc()
    {
        // 右侧边栏 推荐文章
        $articles_tuijiana_data = DB::table('articles')->orderBy('num','desc')->skip(0)->take(4)->get();
        // dd($articles_tuijiana_data);
        return $articles_tuijiana_data;
    }  

    public static function getrightcatesd() 
    {
        // 右侧边栏 点击排行
        $articles_tuijianb_data = DB::table('articles')->orderBy('goodnum','desc')->skip(0)->take(4)->get();

        return $articles_tuijianb_data;
    }
    



    // 封装 栏目的 名称 获取
    public static function getCatesCname()
    {
        // 获取所有的栏目id和名称
        $cates_cname_data = DB::table('cates')->select('id','cname')->get();
        // dd($cates_cname_data);

        $temp = [];
        foreach ($cates_cname_data as $k => $v) {
            $temp[$v->id] = $v->cname;
        }
        // dd($temp);
        return $temp;
 
    }


	// 前台 栏目 数据
	public static function getPidCates()
	{

    	/*
    		把数组放进属性里面
    		Collection {#239 ▼
				  #items: array:2 [▼
				    0 => {#235 ▼
				      +"id": 1
				      +"cname": "技术"
				      +"pid": 0
				      +"path": "0"
				      +"sub": {#242 ▶}
				    }
				    1 => {#237 ▼
				      +"id": 5
				      +"cname": "生活"
				      +"pid": 0
				      +"path": "0"
				      +"sub": {#240 ▶}
				    }
				  ]
				}

    	 */
    	
    	// 获取 栏目
    	$cates_parent_data = DB::table('cates')->where('pid',0)->orderBy('id','asc')->get();


		
    	foreach ($cates_parent_data as $k => $v) {
    		$cates_child_data = DB::table('cates')->where('pid',$v->id)->get();
    		$cates_parent_data[$k]->sub = $cates_child_data;
    		
    	}
    	return $cates_parent_data;
    	// dd($cates_parent_data);
	}

    // 主页面
    public function index()
    {
    	// 获取栏目的数据
    	$cates_data = self::getPidCates();
    	// dd($cates_data);
        
        // 获取 轮播 数据
        $banners_data = DB::table('banners')->where('status',1)->get();

        // 获取 标签云 数据
        $tagnames_data = DB::table('tagnames')->get();

        // 获取 首页 默认显示的 最新数据 默认显示 12 条 
        $articles_data = DB::table('articles')->orderBy('ctime','desc')->skip(0)->take(12)->get();
        // dd($articles_data);
        

        // 右侧边栏 显示两条 
        $articles_prev_data = IndexController::getrightcatesa();
        // dd($articles_data);
        
        // 右侧边栏 特别推荐
        $articles_tuijian_data = IndexController::getrightcatesb();
        // dd($articles_tuijian_data);
        
        // 右侧边栏 推荐文章
        $articles_tuijiana_data = IndexController::getrightcatesc();
        // dd($articles_tuijiana_data);
        
        // 右侧边栏 点击排行
        $articles_tuijianb_data = IndexController::getrightcatesd();

        // 栏目的 名称 获取
        $cates_cname_data = self::getCatesCname();
        // dd($cates_cname_data);
    	
    	return view('home.index.index',['articles_tuijianb_data'=>$articles_tuijianb_data,'articles_tuijiana_data'=>$articles_tuijiana_data,'articles_tuijian_data'=>$articles_tuijian_data,'articles_prev_data'=>$articles_prev_data,'articles_data'=>$articles_data,'tagnames_data'=>$tagnames_data,'banners_data'=>$banners_data,'cates_data'=>$cates_data,'cates_cname_data'=>$cates_cname_data]);
    }
}
