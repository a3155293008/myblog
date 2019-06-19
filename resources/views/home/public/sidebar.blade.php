  <div class="sidebar">
     <div class="zhuanti">
      <h2 class="hometitle">特别推荐</h2>
      <ul>
        @foreach($articles_tuijian_data as $k=>$v)
        <li> <i><img src="/uploads/{{ $v->thumb }}"></i>
          <p>{{ $v->title }} <span><a href="/">阅读</a></span> </p>
        </li>
       @endforeach
      </ul>
    </div>
     <div class="tuijian">
      <h2 class="hometitle">推荐文章</h2>

      <ul class="tjpic">
        <i><img src="/uploads/20190529/GTXBwlf3qw8ZnQmkipvkTjTCki0LxXP0gPNjValQ.png"></i>
        <p><a href="/">据传2500年前，老子出生在周代楚国苦县（今河南鹿邑县）。老子出生时满头白发，众人见过，一片惊嘘。</a></p>
      </ul>
      <ul class="sidenews">
        @foreach($articles_tuijiana_data as $k=>$v)
        <li> <i><img src="/uploads/{{ $v->thumb }}"></i>
          <p><a href="/">{{ $v->desc }}</a></p>
          <span>{{ $v->ctime }}</span> 
        </li>
        @endforeach
      </ul>
    </div>
    <div class="tuijian">
      <h2 class="hometitle">点击排行</h2>
      <ul class="tjpic">
        <i><img src="/uploads/20190529/PaPAh3rE9ensLSpAeOC2XCNY5e0mheqtapFkJANG.jpeg"></i>
        <p><a href="/">孔子周游列国的故事，很多人可能都听说过。但这十四年的漫长旅途，孔子和他的弟子们都去了哪些地方？他们到底是如何“周游”的？我想很多朋友可能就说不太清楚了吧。今天，就让文史君带着大家</a></p>
      </ul>
      <ul class="sidenews">
        @foreach($articles_tuijianb_data as $k=>$v)
        <li> <i><img src="/uploads/{{ $v->thumb }}"></i>
          <p><a href="/">{{ $v->desc }}</a></p>
          <span>{{ $v->ctime }}</span> 
        </li>
        @endforeach
      </ul>
    </div>
    <div class="cloud">
      <h2 class="hometitle">标签云</h2>
      <ul>
        @foreach($tagnames_data as $k=>$v)
        <a href="/home/lists/index?tagname_id={{ $v->id }}" style="background-color: {{ $v->bgcolor }};">{{ $v->tagname }}</a> 
        @endforeach
      </ul>
    </div>
     <div class="guanzhu" id="follow-us">
      <h2 class="hometitle">关注我们 么么哒！</h2>
      <ul>
        <li class="sina"><a href="/" target="_blank"><span>新浪微博</span>博客</a></li>
        <li class="tencent"><a href="/" target="_blank"><span>腾讯微博</span>博客</a></li>
        <li class="qq"><a href="/" target="_blank"><span>QQ号</span>3155293008</a></li>
        <li class="email"><a href="/" target="_blank"><span>邮箱帐号</span>3155293008@qq.com</a></li>
        <li class="wxgzh"><a href="/" target="_blank"><span>微信号</span>xioashuai585</a></li>
        <!-- <li class="wx"><img src="/home/images/wx.jpg"></li> -->
      </ul>
    </div>
  </div>