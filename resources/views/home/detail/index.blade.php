
<!doctype html>
<html>
<head>
@include('home.public.head')
    <link rel="stylesheet" href="/layui-v2.4.5/layui/css/layui.css">
    <script src="/layui-v2.4.5/layui/layui.js"></script>
</head>
<script type="text/javascript">
    // 一般直接写在一个js文件中
    layui.use(['layer','form'],function(){
      var layer = layui.layer;
      

    });
  </script>
<body>
  
<header> 
@include('home.public.header')
</header>
<article>
  <h1 class="t_nav"><span>您现在的位置是：首页 > {{ $cates_cname_data[$data->cid] }}</span><a href="/" class="n1">网站首页</a><a href="/" class="n2">{{ $cates_cname_data[$data->cid] }}</a></h1>
  <div class="infosbox">
    <div class="newsview">
      <h3 class="news_title">{{ $data->title }}</h3>
      <div class="bloginfo">
        <ul>
          <li class="author"><a href="javascript:;">{{ $data->auth }}</a></li>
          <li class="lmname"><a href="javascript:;">{{ $cates_cname_data[$data->cid] }}</a></li>
          <li class="timer">{{ $data->ctime }}</li>
          <li class="view">{{ $data->num }}已阅读</li>
          <li class="like">{{ $data->goodnum }}</li>
        </ul>
      </div>
      <div class="tags"><a href="/home/lists/index?tagname_id={{ $tagname_data->id }}" target="_blank">{{ $tagname_data->tagname }}</a> </div>
      <div class="news_about"><strong>简介</strong>{{ $data->desc }}</div>
      <div class="news_con"> 
        {!! $data->content !!}
      </div>
    <div class="share">
      <p class="diggit"><a href="" onclick='goodnum( {{$data->id}} )'> 很赞哦！ </a></p>
      <p class="dasbox"><a href="javascript:void(0)" onClick="dashangToggle()" class="dashang" title="打赏，支持一下">打赏本站</a></p>
      <div class="hide_box"></div>
      <div class="shang_box"> <a class="shang_close" href="javascript:void(0)" onclick="dashangToggle()" title="关闭">关闭</a>
        <div class="shang_tit">
          <p>感谢您的支持，我会继续努力的!</p>
        </div>
        <div class="shang_payimg"> <img src="/home/images/alipayimg.jpg" alt="扫码支持" title="扫一扫"> </div>
        <div class="pay_explain">扫码打赏，你说多少就多少</div>
        <div class="shang_payselect">
          <div class="pay_item checked" data-id="alipay"> <span class="radiobox"></span> <span class="pay_logo"><img src="/home/images/alipay.jpg" alt="支付宝"></span> </div>
          <div class="pay_item" data-id="weipay"> <span class="radiobox"></span> <span class="pay_logo"><img src="/home/images/wechat.jpg" alt="微信"></span> </div>
        </div>
        
        <script type="text/javascript">
          // 点赞
          function goodnum(id)
          {
            // alert($);
             // 修改页面dom 元素
                  $('.like').eq(0).html();

                  let like = $('.like').first();
                  like.html(parseInt(like.html())+1);

            $.get('/home/detail/goodnum',{id:id},function(res){
              // alert(res);
              if (res.msg == 'err') {
                  layer.msg(res.info);
              } else {
                  layer.msg(res.info);

                 
              }
            },'json');
          }
        </script>

        <script type="text/javascript">
            $(function(){
            	$(".pay_item").click(function(){
            		$(this).addClass('checked').siblings('.pay_item').removeClass('checked');
            		var dataid=$(this).attr('data-id');
            		$(".shang_payimg img").attr("src","images/"+dataid+"img.jpg");
            		$("#shang_pay_txt").text(dataid=="alipay"?"支付宝":"微信");
            	});
            });
            function dashangToggle(){
            	$(".hide_box").fadeToggle();
            	$(".shang_box").fadeToggle();
            }
        </script> 
      </div>
    </div>
    <div class="nextinfo">
      <p>上一篇：

        @if ($article_prev)
        <a href="/home/detail/index?id={{ $article_prev->id }}&cid={{ $article_prev->cid }}&tagname_id={{ $article_prev->tid }}">{{ $article_prev->title }}</a>
        @endif

      </p>
      <p>下一篇：

        @if ($article_next)
        <a href="/home/detail/index?id={{ $article_next->id }}&cid={{ $article_next->cid }}&tagname_id={{ $article_next->tid }}">{{ $article_next->title }}</a>
        @endif

      </p>
    </div>
    <div class="otherlink">
      <h2>相关文章</h2>
      <ul>
        @foreach($articles_all_data as $k=>$v)
        <li><a href="javascript:;" title="{{ $v->desc }}">{{ $v->title }}</a></li>
        @endforeach
      </ul>
    </div>
  <div class="news_pl">
          <!-- 文章评论开始 -->
      <form action="/home/detail/pinglun" method="get">
          <input type="hidden" name="tid" value="{{$data->id}}">
         
        <h4>文章评论:</h4><textarea style="height:100px;" name="pcontent" class="nextinfo"></textarea>
        <input type="submit" value="提交" class="nextinfo">
      </form>
      <!-- 文章评论结束 -->

      <!-- 查看评论内容开始 -->  
    <div class="comment-entry f-12 first">
      @foreach($pcontent_data as $k=>$v)
     <div class="comment-item">  
        <div class="details f-aid">
          <span>头像:<img style="width:100px;" src="/uploads/{{$v->thumb}}"></span>
          <br> 
          <span>用户名称:{{$v->uname}}</span>
          <br>
           <span class="comment-entry-time">评论时间:{{$v->ctime}}</span>  
           </div>   
          <div class="comment-content">      
            评论内容:{{$v->pcontent}}
           </div> 
                  
     </div> 
      @endforeach 
   </div>
   <!-- <div style="width:630px; height:500px; border:1px solid red;">
     @foreach($pcontent_data as $k=>$v)
      <div class="comment-item">
        <div class="details f-aid">
          <span>用户名称:{{$v->uname}}</span>
          <span>头像:<img style="width:50px;" src="/uploads/{{$v->thumb}}"></span>
          <span class="comment-entry-time">评论时间:{{$v->ctime}}</span>
        </div>

        <div class="comment-content">      
            评论内容:{{$v->pcontent}}
        </div> 
        
      </div>
     @endforeach
   </div> -->
  
  <!-- 查看评论内容结束 -->

      <ul>
        <div class="gbko">
        </div>
      </ul>
    </div>
  </div>
</div>
@include('home.public.sidebar')
</article>

<footer>
  <p>Design by <a href="http://swarp.wang" target="_blank">王帅一期</a> <a href="/">蜀ICP备11002373号-1</a></p>
</footer>
<a href="#" class="cd-top">Top</a>
</body>
</html>
