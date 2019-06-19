<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href="https://cdn.bootcss.com/twitter-bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/twitter-bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	  <link rel="stylesheet" href="/layui-v2.4.5/layui/css/layui.css">
  	  <script src="/layui-v2.4.5/layui/layui.js"></script>

</head>

<body>
	<div class="container">
		
		<form action="/home/register/store" method="post">
		  <div class="form-group">
		    <label for="uname">用户名</label>
		    <input type="text" class="form-control" id="uname" name="uname" placeholder="用户名">
		  </div>
		  <div class="form-group">
		    <label for="pass">密码</label>
		    <input type="password" class="form-control" id="pass" name="pass" placeholder="密码">
		  </div>

		  <div class="form-group">
		    <label for="repass">确认密码</label>
		    <input type="password" class="form-control" id="repass" name="repass" placeholder="确认密码">
		  </div>

		  <div class="form-group">
		    <label for="code">验证码</label>
		    <br>
		    <input type="text" class="form-control" id="code" name="code" placeholder="验证码" style="width:40%; display: inline;">
		    <!-- <img src="{{captcha_src()}}"  alt="验证码加载失败"> -->
		    <img src="{{captcha_src()}}" style="border-radius: 5px;" onclick="this.src='{{captcha_src()}}'+Math.random()">
		  </div>
		  <button type="submit" class="btn btn-success form-control">注册</button>
		</form>
	</div>
</body>
<script type="text/javascript">
  // 一般直接写在一个js文件中
  layui.use(['layer','form'],function(){
    var layer = layui.layer;
    

  });
</script>
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('form:first').submit(function(){
		// if(reg.test(email) ==false){   

		//     $email_prompt.html("电子邮件格式不正确,请重新输入");

		//     return false;   
		// }
		// 验证表单,数据验证
		var uname = $('form input[name=uname]').val();
		var uname_reg = /^[a-zA-Z]{1,7}[1-9]{3,7}$/;
		if (uname_reg.test(uname) == false) {
			layer.msg('用户名格式错误');
			return false;
		}
		var pass = $('form input[name=pass]').val();
		var repass = $('form input[name=repass]').val();

		var code = $('form input[name=code]').val();
		if (pass != repass) {
			layer.msg('两次密码不一致')
			return false;
		}

		//发送ajax
		$.post('/home/register/store',{uname,pass,code},function(res){
			if (res.msg == 'ok') {
				
				layer.msg(res.info);

				setTimeout(function(){
					// 关闭当前打开的窗口
					window.parent.location.reload();
					var index = parent.layer.getFrameIndex(window.name);
					let res = parent.layer.close(index);

					// 跳转
					location.href = "/home/login/login";
					return false;
				},500);


			} else {
				layer.msg(res.info);
			}
		},'json');

		return false;
	})
</script>
</html>