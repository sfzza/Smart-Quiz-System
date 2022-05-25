<nav class="navbar navbar-expand navbar-dark topbar mb-4 static-top shadow" style="background: #87B1FD; no-repeat; padding-top: 10px; height: 100px;">
  
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
	
  </button>

			<div style="color: white" class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-text mx-0"><h2><strong>SMART QUIZ SYSTEM </strong></h2>
        									                   <h4><strong>TEAM BLACK MIRROR</strong></h4>
        </div>
  </div>
	<ul class="navbar-nav ml-auto">

				<div class = "nav navbar-nav navbar-right">
					<a href="logout.php" class="text-light"><?php echo $name ?> </a>
					
				</div>
			</div>
		</nav>
		<div id="sidebar" class="nav-item active" style="background: #87B1FD">
		

		
			<div id="sidebar-field">
				<a href="home.php" class="sidebar-item text-light">
						<div class="sidebar-icon"></div>  Home
				</a>
			</div>
			<div id="sidebar-field">
				<a href="account.php" class="sidebar-item text-light">
						<div class="sidebar-icon"></div>  Account
				</a>
			</div>
			<?php if($_SESSION['login_user_type'] != 3): ?>
			<?php if($_SESSION['login_user_type'] == 1): ?>
			<div id="sidebar-field">
				
			</div>
		<?php endif; ?>
			<?php if($_SESSION['login_user_type'] == 1) {
				echo '<div id="sidebar-field">
				<a href="list_user.php" class="sidebar-item text-light">
						<div class="sidebar-icon"></div>  User List
				</a>
			</div>';
			}?>
			

			<div id="sidebar-field">
				<a href="quiz.php " class="sidebar-item text-light">
						<div class="sidebar-icon"></div>  Quiz List
				</a>
			</div>
			<div id="sidebar-field">
				<a href="history.php " class="sidebar-item text-light">
						<div class="sidebar-icon"></div>  Quiz Records
				</a>
			</div>
			<?php else: ?>
			<div id="sidebar-field">
				<a href="student_quiz_list.php " class="sidebar-item text-light">
						<div class="sidebar-icon"></div>  Quiz List
				</a>
			</div>
		<?php endif; ?>

		</div>
		<script>
			$(document).ready(function(){
				var loc = window.location.href;
				loc.split('{/}')
				$('#sidebar a').each(function(){
					if($(this).attr('href') == loc.substr(loc.lastIndexOf("/") + 1)){
						$(this).addClass('active')
					}
				})
			})
			
		</script>