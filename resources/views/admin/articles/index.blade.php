
<!DOCTYPE HTML>
<html>
<head>
@include('admin.public.header')
<!--//Metis Menu -->

<style type="text/css">
	.hides{
		overflow:hidden;
		text-overflow:ellipsis;
		white-space:nowrap;
	}
</style>

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
				
				<h3 class="title1">文章管理</h3>

				<!-- 搜索 开始 -->
				<div class="form-body" data-example-id="simple-form-inline">
							<form class="form-inline" action="/admins/articles/index"> 
								<!-- {{ csrf_field() }} -->
								<div class="form-group"> 
									<label for="exampleInputName2">关键字</label> 
									<input type="text" class="form-control" value="{{ $search }}" name="search" id="exampleInputName2" placeholder="标题"> 
								</div> 
								
								<button type="submit" class="btn btn-default">搜索</button> 
							</form> 
						</div>
				<!-- 搜索 结束 -->

				<div class="panel-body widget-shadow">
						<h4> 文章列表:</h4>
						<table class="table">
							<thead>
								<tr>
								  <th>ID</th>
								  <th>文章标题</th>
								  <th>作者</th>
								  <th>描述</th>
								  <th>创建时间</th>
								  <th>缩略图</th>
								  <th>浏览量</th>
								  <th>点赞量</th>
								  <th>操作</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $k=>$v)
								<tr>
									<th> {{ $v->id }} </th>
									<td>
										<p title="{{ $v->title }}" style="width:70px;" class="hides">{{ $v->title }}</p>
									</td>
									<td>
										<p style="width:50px;" class="hides">{{ $v->auth }}</p>
									</td>
									<td>
										<p title="{{ $v->desc }}" style="width:150px;" class="hides">{{ $v->desc }}</p>
									</td>
									<td>{{ $v->ctime }}</td>
									<td>
										<img style="width:70px;" class="img-thumbnail" src="/uploads/{{ $v->thumb }}">
									</td>
									<td>{{ $v->num }}</td>
									<td>{{ $v->goodnum }}</td>

									
									<!-- 隐藏文章内容, jQuery获取数据,填入模态框 -->
									<td class="template" style="display:none;">
										<span>{{ $v->title }}</span>
										<div>{!! $v->content !!}</div>
									</td>


									<td>
										<a href="javascript:;" class="btn btn-danger" onclick="del({{$v->id}},this)">删除</a>
										<a href="/admins/articles/edit/{{ $v->id }}" class="btn btn-primary">修改</a>
										<a href="javascript:;" class="btn btn-success" onclick="show({{ $v->id }},this)">查看文章内容</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<script type="text/javascript">
							function del(id,obj){
								// let token = $(obj).attr('token');
								// console.log(token);
								// return false;
								if(!window.confirm('你确定要删除吗?')){
									return false;
								}

								$.get('/admins/articles/destroy',{id:id},function(res){
									if(res == 'ok'){
										// 删除tr节点
										$(obj).parent().parent().remove();
									}else{
										alert('删除失败')
									}
								},'html');
							}

							function show(id,obj)
							{
								// if (sta == 1){
								// 	// 赋值
								// $('#myModal form input[type=hidden]').eq(1).attr('checked',true);
								// } else {
								// 	// 赋值
								// $('#myModal form input[type=hidden]').eq(0).attr('checked',true);
								// }
								// $('#myModal form input[type=hidden]').eq(0).val(id);
								
								// 获取标题
								let title = $(obj).parent().prev().find('span').eq(0).html();
								// let title = $(obj).parent().prev().find('span').first().html();
								let content = $(obj).parent().prev().find('div').eq(0).html();

								
								$('#myModals .modal-title').html(title);
								$('#myModals .modal-body').html(content);

								$('#myModals').modal('show');
							}
						</script>
						

						<!-- Modal -->
						<div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">文章状态</h4>
						      </div>
						      <div class="modal-body">
						       
						      </div>
						      
						    </div>
						  </div>
						</div>
				</div>

						<div>
							<!-- 显示页码 -->
							{{ $data->appends(['search'=>$search])->links() }}
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