
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
				<h3 class="title1">标签云管理</h3>
				<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
					<div class="form-title">
						<h4>标签云添加 :</h4>
					</div>
					<div class="form-body">
						  <form action="/admins/tagnames/store" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
						    <div class="form-group">
						      <label for="tagname">标签云名称</label>
						      <input type="text" class="form-control" value="{{ old('tagname') }}" name="tagname" id="tagname" placeholder="标签云名">
						  	</div>

						  	<div class="form-group">
						      <label for="bgcolor">所属标签云</label>
							 <input type="color" name="bgcolor" id="bgcolor" value="" class="form-control">
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