
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