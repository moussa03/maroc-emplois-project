<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Google Nexus Website Menu</title>
		<meta name="description" content="A sidebar menu as seen on the Google Nexus 7 website" />
		<meta name="keywords" content="google nexus 7 menu, css transitions, sidebar, side menu, slide out menu" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico">
        <link href="{{ asset('css/demo.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('css/component.css')}}" />
        <script src="{{asset('js/modernizr.custom.js')}}"></script>
	</head>
	<body>
		<div class="container">
			<ul id="gn-menu" class="gn-menu-main">
				<li class="gn-trigger">
					<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
					<nav class="gn-menu-wrapper">
						<div class="gn-scroller">
							<ul class="gn-menu">
								
								<li>
									<a> <span class="d-inline-block "> <i class="fa fa-th-large"> </i> </span> Dashboard </a>
									
								</li>
								<li> <a> <span class="d-inline-block"><i class="fa fa-user"></i></span> profile</a></li>
								<li><a> <span class="d-inline-block"> <i class="fa fa-paper-plane"></i></span> publier une annonce</a></li>
								<li><a> <span class="d-inline-block"> <i class="fa fa-star"></i></span> applicant job</a></li>
								<li><a> <span class="d-inline-block"> <i class="fa fa-bell"></i></span> Candidates Alerts</a></li>
								<li><a> <span class="d-inline-block"> <i class="fa fa-lock"></i></span> change password</a></li>
								<li><a> <span class="d-inline-block"> <i class="fas fa-sign-out-alt"></i></span> sign out</a></li>
								<li><a> <span class="d-inline-block"> <i class="far fa-trash-alt"></i></span> delete profile</a></li>
								
							</ul>
						</div><!-- /gn-scroller -->
					</nav>
				</li>
			
			</ul>
			
		</div><!-- /container -->
    <script src="{{asset('js/classie.js')}}"></script>
    <script src="{{asset('js/gnmenu.js')}}"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
	</body>
</html>