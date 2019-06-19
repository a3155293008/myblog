
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
				
				<h3 class="title1">轮播图管理</h3>

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
						<h4> 轮播图列表:</h4>
						<table class="table">
							<thead>
								<tr>
								  <th>ID</th>
								  <th>轮播图标题</th>
								  <th>图片</th>
								  <th>状态</th>
								  <th>操作</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $k=>$v)
								<tr>
									<th>{{ $v->id }}</th>
									<td>{{ $v->title }}</td>
									<td>
										<img title="{{ $v->desc }}" src="/uploads/{{ $v->url }}" style="width:80px;" class="img-thumbnail">
									</td>
									<td>
										@if($v->status == 0)
										<kbd>未激活</kbd>
										@else
										<kbd style="background-color:green;">激活</kbd>
										@endif
										<!-- {{ $v->status }} -->
									</td>
									<td>
										<a href="javascript:;" class="btn btn-danger" onclick="del({{ $v->id }},this)">删除</a>
										<a href="/admins/banners/edit/{{ $v->id }}" class="btn btn-success">修改</a>
										

										@if($v->status == 0)
										<a href="javascript:;" class="btn btn-info" onclick="changeStatus({{ $v->id }},0)">激活</a>
										@else
										<a href="javascript:;" class="btn btn-primary" onclick="changeStatus({{ $v->id }},1)">停止</a>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<script type="text/javascript">
							// 删除
							function del(id,obj)
							{
								// let token = $(obj).attr('token');

								if(!window.confirm('你确定要删除吗?')){
									return false;
								}

								$.get('/admins/banners/destroy',{id:id},function(res){
									if(res == 'ok'){
										// 删除tr节点
										$(obj).parent().parent().remove();
									}else{
										alert('删除失败')
									}
								},'html');
							}


							// 状态 激活 停止
							function changeStatus(id,sta)
							{
								if (sta == 1){
									// 赋值
								$('#myModals  form input[type=hidden]').eq(1).attr('checked',true);
								} else {
									// 赋值
								$('#myModals form input[type=hidden]').eq(0).attr('checked',true);
								}
								$('#myModals form input[type=hidden]').eq(0).val(id);
								$('#myModals').modal('show')
							}
						</script>
						

						<!-- Modal -->
						<div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">轮播图状态</h4>
						      </div>
						      <div class="modal-body">
						       <form action="/admins/banners/changeStatus" method="get">
						       	<input type="hidden" name="id" value="">
									<div class="form-group">
								      未开启<input type="radio" name="status" value="0" checked>
								      &nbsp;&nbsp;&nbsp;
								      开启<input type="radio" name="status" value="1">
								  	</div>
								  	<input type="submit">
						       </form>
						      </div>
						      
						    </div>
						  </div>
						</div>
					</div>
					

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