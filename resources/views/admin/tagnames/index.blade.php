
<!DOCTYPE HTML>
<html>
<head>
@include('admin.public.header')
<!--//Metis Menu -->
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--侧边栏 开始-->
		@include('admin.public.sidebar')
		<!--侧边栏 结束-->

		<!-- 头部 开始 -->
		@include('admin.public.header_userinfo')
		<!-- 头部 结束-->

        <div class="copyrights">Collect from <a href="http://www.cssmoban.com/" >手机网站模板</a></div>
		
		<!-- 内容 开始-->
		<div id="page-wrapper">
			<!-- <div class="main-page"></div> -->
			<div class="main-page">
				<!-- 导入 提示消息 -->
				@include('admin.public.message')
				
				<h3 class="title1">标签云管理</h3>

				<!-- 搜索 开始 -->
				<div class="form-body" data-example-id="simple-form-inline">
							<form class="form-inline" action="/admins/users/index"> 
								<div class="form-group"> 
									<label for="exampleInputName2">关键字</label> 
									<input type="text" class="form-control" value="" name="search" id="exampleInputName2" placeholder="用户名"> 
								</div> 
								
								<button type="submit" class="btn btn-default">搜索</button> 
							</form> 
						</div>
				<!-- 搜索 结束 -->

				<div class="panel-body widget-shadow">
						<h4> 标签云列表:</h4>
						<table class="table">
							<thead>
								<tr>
								  <th>ID</th>
								  <th>标签云名称</th>
								  <th>标签云颜色</th>
								  <th>操作</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $k=>$v)
								<tr>
									<th>{{ $v->id }}</th>
									<td>{{ $v->tagname }}</td>
									<td>
										<kbd style="background-color:{{ $v->bgcolor }};">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</kbd>
									</td>
									<td>
										<a href="javascript:;" class="btn btn-danger" onclick="del({{ $v->id }},this)">删除</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<script type="text/javascript">
						function del(id,obj)
						{
							if(!window.confirm('你确定要删除吗?')){
							return false;
							}

							$.get('/admins/tagnames/destroy',{id:id},function(res){
								if(res == 'ok'){
									// 删除tr节点
									$(obj).parent().parent().remove();
								}else{
									alert('删除失败')
								}
							},'html');
						}
					</script>
					

				<div class="row calender widget-shadow" style="display:none;">
					<h4 class="title">Calender</h4>
					<div class="cal1">
						
					</div>
				</div>


			</div>
		</div>
		<!-- 内容 结束 -->

		<!--页脚 开始-->
		@include('admin.public.footer')
        <!--页脚结束-->
        
	</div>
	<!-- 页脚静态资源 kais -->
	@include('admin.public.footer_static')
   <!-- 页脚静态资源结束 -->
</body>
</html>