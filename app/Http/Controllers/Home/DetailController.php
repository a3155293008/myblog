<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class DetailController extends Controller
{
    private static function prev($id,$cid)
    {
        $data = DB::table('articles')->where('id','<',$id)->where('cid',$cid)->orderBy('id','desc')->first();
        if ($data) {
            return $data;
        } else {
            return false;
        }
        
    }

    private static function next($id,$cid)
    {
        $data = DB::table('articles')->where('id','>',$id)->where('cid',$cid)->orderBy('id','asc')->first();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }


    // 显示 主页
    public function index(Request $request)
    {
    	// 获取栏目的数据
    	$cates_data = IndexController::getPidCates();
    	// dd($cates_data);
    	
    	// 获取 轮播 数据
    	$banners_data = DB::table('banners')->where('status',1)->get();

    	// 获取文章id
    	$id = $request->input('id',0);

        // 修改 文章  的  阅读量
        DB::update('update articles set num=num+1 where id ='.$id);

    	// 获取文章 详情
        $data = DB::table('articles')->where('id',$id)->first();

        // 查询所有文章
    	$articles_all_data = DB::table('articles')->select('title','desc')->get();


    	// 子栏目id
    	$cid= $request->input('cid',0);
    	// dd($cid);
    	// 分配子栏目所属父级栏目名称
        $cates_cname_data = IndexController::getCatesCname();
    	// $cname = DB::table('cates')->select('cname')->where('id',$cid)->first();
    	// dd($cname);		// 是个对象
    	


        // 获取右侧边栏
        $articles_tuijian_data = IndexController::getrightcatesb();
        $articles_tuijiana_data = IndexController::getrightcatesc();
        $articles_tuijianb_data = IndexController::getrightcatesd();



    	// 标签云id
    	$tagname_id = $request->input('tagname_id',0);

    	// 获取对应的标签云信息
    	$tagname_data = DB::table('tagnames')->where('id',$tagname_id)->first();

    	// 获取 标签云 数据
        $tagnames_data = DB::table('tagnames')->get();

       

        // 上一条
        $article_prev = self::prev($id,$request->input('cid',0));
        // 下一条
        $article_next = self::next($id,$request->input('cid',0));
        // dd($article_next);
        

        //显示评论文章内容
          $pcontent_data = DB::table('pinglun as p')
          ->join('users as u','u.id','=','p.uid')
          ->select('u.uname','u.thumb','p.pcontent','p.ctime')
          ->where(['tid'=>$id])
          ->orderBy('ctime','desc')
          ->get();


          // dd($pcontent_data);
    	return view('home.detail.index',[
            'articles_all_data'=>$articles_all_data,
            'pcontent_data'=>$pcontent_data,
            'articles_tuijianb_data'=>$articles_tuijianb_data,
            'articles_tuijiana_data'=>$articles_tuijiana_data,
            'articles_tuijian_data'=>$articles_tuijian_data,
            'tagname_data'=>$tagname_data,
            'cates_cname_data'=>$cates_cname_data,
            'data'=>$data,
            'banners_data'=>$banners_data,
            'cates_data'=>$cates_data,
            'tagnames_data'=>$tagnames_data,
            'article_prev'=>$article_prev,
            'article_next'=>$article_next
        ]);
    }

    // 点赞
    public function goodnum(Request $request)
    {
        $id = $request->input('id',0);
        // $res = DB::update('update articles set goodnum=goodnum+1 where id='.$id);

        // 检测当前该用户是否给该文章 点赞过
        
        // 检测用户是否登录
        if (!session('home_login')) {
            echo json_encode(['msg'=>'err','info'=>'请先登录']);
            exit;
        }

        // 获取用户id
        $uid = session('home_userinfo')->id;
        // dd($uid);
        
        // 所有 点赞文章
        $tids = DB::table('users_articles')->where('uid',$uid)->select('tid')->get();
        // dd($tids);
        $tids_all = [];
        foreach ($tids as $k => $v) {
            $tids_all[] = $v->tid;
        }
        // dd($tids_all);

        // 检测是否点赞
        if (in_array($id, $tids_all)) {
            echo json_encode(['msg'=>'err','info'=>'已点赞']);
            exit;
        }

        // 修改点赞字段
         $res = DB::update('update articles set goodnum=goodnum+1 where id='.$id);

         // 记录点赞信息
         DB::table('users_articles')->insert(['uid'=>$uid,'tid'=>$id]);



        if ($res) {
             echo json_encode(['msg'=>'ok','info'=>'+1']);
             exit;
        } else {
             echo json_encode(['msg'=>'err','info'=>'点赞失败']);
             exit;
        }
    }

     //文章评论
    public function pinglun(Request $request)
    {
        //获取文章的id 
       $data['tid'] = $request->input('tid');
       // dd($data);
     

       //判断用户是否登录
       if(!session('home_login')){
           return back()->with('error','请你先登录');
       }
       //获取uid
       $data['uid'] = session('home_userinfo')->id;

        //获取评论的文章内容
        $data['pcontent'] = $request->input('pcontent');
        $data['ctime'] = date('Y-m-d H:i:s',time());

        // dd($data);
       
        $res = DB::table('pinglun')->insert($data);
        if($res){
            return back()->with('success','评论成功');
        }else{
            return back()->with('error','评论失败');
        }
    }  

}
