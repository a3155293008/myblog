
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
			@if (count($errors) > 0)
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
			@endif
			
			<div class="forms">
				<h3 class="title1">栏目管理</h3>
				<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
					<div class="form-title">
						<h4>栏目添加 :</h4>
					</div>
					<div class="form-body">
						  <form action="/admins/cates/store" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
						    <div class="form-group">
						      <label for="cname">栏目名</label>
						      <input type="text" class="form-control" value="{{ old('cname') }}" name="cname" id="cname" placeholder="栏目名">
						  	</div>

						  	<div class="form-group">
						      <label for="pid">所属栏目</label>
							  <select name="pid" class="form-control">
								<option value="0">--请选择--</option>
								@foreach($cates_data as $k=>$v)
								@if($v->pid == 0) 
									<option value="{{ $v->id }}" {{ $id == $v->id ? 'selected' : ''  }} style="font-weight:bold;">{{ $v->cname }}</option>
								@else
									<option value="{{ $v->id }}" disabled>{{ $v->cname }}</option>
								@endif
								
								@endforeach
							  </select>
						  	</div>
						    

						   
						   <button type="submit" class="btn btn-default">Submit</button>
						</form>
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