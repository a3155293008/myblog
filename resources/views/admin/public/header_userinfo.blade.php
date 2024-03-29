<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<!--logo -->
				<div class="logo">
					<a href="index.html">
						<h1>NOVUS</h1>
						<span>AdminPanel</span>
					</a>
				</div>
				<!--//logo-->
				<!--search-box-->
				<div class="search-box">
					<form class="input">
						<input class="sb-search-input input__field--madoka" placeholder="Search..." type="search" id="input-31" />
						<label class="input__label" for="input-31">
							<svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
								<path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
							</svg>
						</label>
					</form>
				</div><!--//end-search-box-->
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">
			
				<!--notification menu end -->
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<span class="prfil-img"><img class="img-thumbnail" style="width:70px; border-radius: 50%;" src="/uploads/{{ session('admin_userinfo')->profile }}" alt=""> </span> 
									<div class="user-name">
										<p>{{ session('admin_userinfo')->uname }}</p>
										<span>Administrator</span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="#"><i class="fa fa-cog"></i> 修改密码</a> </li> 
								<li> <a href="#"><i class="fa fa-user"></i> 头像</a> </li> 
								<li> <a href="/admins/logout"><i class="fa fa-sign-out"></i> 退出</a> </li>
							</ul>
						</li>
					</ul>
				</div>
				
				<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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

				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>
		