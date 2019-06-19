  <!--menu begin-->
  <div class="menu">
    <nav class="nav" id="topnav">
      <h1 class="logo"><a href="/home/index/index">王帅博客</a></h1>

      <!-- 显示栏目 开始 -->
      @foreach($cates_data as $k=>$v)
      <li><a href="javascript:;">{{ $v->cname }}</a>
        <ul class="sub-nav">
          @foreach($v->sub as $key=>$value)
          <li><a href="/home/lists/index?cid={{ $value->id }}">{{ $value->cname }}</a></li>
          @endforeach
        </ul>
      </li>
      @endforeach
      <!-- 显示栏目 结束 -->
      
      <!--search begin-->
      <!-- <div id="search_bar" class="search_bar" style="position: relative;left: -100px; width: 200px;">
        <form  id="searchform" action="/home/lists/index" method="get" name="searchform">
          <input class="input" placeholder="想搜点什么呢..." type="text" value="" name="search" id="search" style="width:160px;">
          <input type="submit" value="搜索" style="position: absolute; left: 0px; top:15px; height: 30px;">
          <input type="hidden" name="show" value="title" />
          <input type="hidden" name="tempid" value="1" />
          <input type="hidden" name="tbname" value="news">
          <input type="hidden"  value="搜索" />
          <span class="search_ico"></span>
        </form>
      </div> -->
     <div id="search_bar" class="search_bar" style="position: relative;left: -100px; width: 200px;">
        <form id="searchform" action="/home/lists/index" method="get">
            <input class="input" placeholder="想搜点什么呢..." type="text" value="" name="search" style="width:160px;">
            <!-- <input type="hidden" value="提交"> -->
            <!-- <span class="search_ico"></span> -->
            
        </form>
     </div>
      
      <!--search end--> 
      <div style="position: relative; right:-640px;">
        @if (session('home_login')) 
        <a href="/home/login/login" style="color:#fff;">{{ session('home_userinfo')->uname }}</a>
        <a href="/home/login/logout" style="color:#fff;">退出</a>
        @else
        <a href="/home/login/login" style="color:#fff;">登录</a>&nbsp;
        <a href="javascript:;" onclick="register()" style="color:#fff;">注册</a>
        @endif
      </div>
    </nav>
  </div>

  <link rel="stylesheet" href="/layui-v2.4.5/layui/css/layui.css">
  <script src="/layui-v2.4.5/layui/layui.js"></script>

<script type="text/javascript">
  // 一般直接写在一个js文件中
  layui.use(['layer','form'],function(){
    var layer = layui.layer;
    

  });
</script>

  <script type="text/javascript">
    function register(){
      // iframe层-父子操作
      layer.open({
        type: 2,
        title: '注册',
        area: ['700px','450px'],
        fixed: false,  // 不固定
        maxmin: true,
        content: '/home/register/index'
      });
    }
  </script>

  <!--menu end--> 
  <!--mnav begin-->
  <div id="mnav">
    <h2><a href="http://www.yangqq.com" class="mlogo">王帅博客</a><span class="navicon"></span></h2>
    <dl class="list_dl">
      <dt class="list_dt"> <a href="index.html">网站首页</a> </dt>
      <dt class="list_dt"> <a href="about.html">关于我</a> </dt>
      <dt class="list_dt"> <a href="#">模板分享</a> </dt>
      <dd class="list_dd">
        <ul>
          <li><a href="share.html">个人博客模板</a></li>
          <li><a href="share.html">国外Html5模板</a></li>
          <li><a href="share.html">企业网站模板</a></li>
        </ul>
      </dd>
      <dt class="list_dt"> <a href="#">学无止境</a> </dt>
      <dd class="list_dd">
        <ul>
          <li><a href="list.html">心得笔记</a></li>
          <li><a href="list.html">CSS3|Html5</a></li>
          <li><a href="list.html">网站建设</a></li>
          <li><a href="list.html">推荐工具</a></li>
          <li><a href="list.html">JS实例索引</a></li>
        </ul>
      </dd>
      <dt class="list_dt"> <a href="#">慢生活</a> </dt>
      <dd class="list_dd">
        <ul>
          <li><a href="life.html">日记</a></li>
          <li><a href="life.html">欣赏</a></li>
          <li><a href="life.html">程序人生</a></li>
          <li><a href="life.html">经典语录</a></li>
        </ul>
      </dd>
      <dt class="list_dt"> <a href="time.html">时间轴</a> </dt>
      <dt class="list_dt"> <a href="gbook.html">留言</a> </dt>
    </dl>
  </div>
  <!--mnav end--> 