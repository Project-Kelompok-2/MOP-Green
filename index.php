<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<title>MOP Green</title>
	<!-- MDB icon -->
	<link rel="icon" href="img/logo2.png" type="image/x-icon" />
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
	<style type="text/css">
		*{
			scroll-behavior: smooth;
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		.nav-link:hover{
			background-color: #00663c;
			color: white;
			transition-delay:0.1s;
/*			border-radius: 5px;*/
		}
		.active{
			background-color: #00663c;
/*			border-radius: 5px;*/
		}
		.bg-img{
			background-image: url("img/bg3.jpg");
			/*filter: blur(8px);*/
			/*-webkit-filter: blur(8px);*/
			height: 100%;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
		#welcome h1{
			font-size: 4rem;
			font-weight: bold;
			text-transform: uppercase;
			opacity: 0.8;
			color: #fff;
			text-shadow: 5px 10px 5px rgba(0,0,0,0.5);
			text-align: center;
			margin:0;
		}
		#map h1{
			font-size: 4rem;
			font-weight: bold;
			text-transform: uppercase;
			opacity: 0.8;
			color: #fff;
			text-shadow: 5px 10px 5px rgba(0,0,0,0.5);
			text-align: center;
			margin:0;
		}
		#map{

		}
		#about h1{
			font-size: 4rem;
			font-weight: bold;
			text-transform: uppercase;
			opacity: 0.8;
			color: #fff;
			text-shadow: 5px 10px 5px rgba(0,0,0,0.5);
			text-align: center;
			margin:0;
		}
		#about{
		}
		.banner-image{
			background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),url('img/bg3.jpg');
			background-size: cover;
		}
	</style>
</head>
<body>
	<!-- NAVBAR -->
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">
				<img src="img/logo2.png" alt="Logo" width="70" height="50" class="d-inline-block">
				<strong>MOP GREEN</strong>
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-end flex-column flex-sm-row" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<a class="nav-link" href="#welcome"><h5>Home</h5></a>
					
					<a class="nav-link" href="#map"><h5>Map Green House</h5></a>
					
					<a class="nav-link" href="#about"><h5>About</h5></a>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fa fa-user"></i></a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item" href="login.php"><h6>Login</h6></a></li>
						</ul>
					</li>
				</div>
			</div>
		</div>
	</nav>

	<!-- Banner Image & Welcome -->
	<section id="welcome">
		<div class="banner-image w-100 vh-100 d-flex justify-content-center align-items-center">
			<div class="content text-center ">
				<h1>
					Welcome
				</h1>
			</div>
		</div>
	</section>

	<!-- Main Content Area -->
	<section class="bg-dark" id="map">
		<h1>
			Map
		</h1>
		<img src="img/Map Green House.png" class="img-fluid" alt="Green House Map">
	</section>
	<section class="bg-dark" id="about">
		<h1>
			About Us
		</h1>
		<div class="container">
		<div class="row text-center text-white">
			<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<img class="rounded-circle" src="img/bg.jpg" height="100" width="100">
				<h2>Akbar Ramadhani Firdaus</h2>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<img class="rounded-circle" src="img/bg.jpg" height="100" width="100">
				<h2>Akbar Ramadhani Firdaus</h2>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<img class="rounded-circle" src="img/bg.jpg" height="100" width="100">
				<h2>Akbar Ramadhani Firdaus</h2>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>
		</div>
		<div class="row text-center text-white">
			<div class="col-lg-6 col-md-6 col-sm-12 col-12">
				<img class="rounded-circle" src="img/bg.jpg" height="100" width="100">
				<h2>Akbar Ramadhani Firdaus</h2>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-12">
				<img class="rounded-circle" src="img/bg.jpg" height="100" width="100">
				<h2>Akbar Ramadhani Firdaus</h2>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>
		</div>
		</div>
	</section>

	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<!-- Navbar -->
	<script>
		const a=document.querySelectorAll(".nav-link");
		const sec=document.querySelectorAll("section");

		function activeMenu(){
			let len=sec.length;
			while(--len && window.scrollY + 100 < sec[len].offsetTop){}
				a.forEach(ltx => ltx.classList.remove("active"));
			a[len].classList.add("active");
			a.forEach(ltx => ltx.classList.remove("active2",'text-white'));
			a[len].classList.add("active2",'text-white');
		}
		activeMenu();
		window.addEventListener("scroll",activeMenu);
	</script>
	<script>
		var nav=document.querySelector('nav');
		window.addEventListener('scroll',function(){
			if (window.pageYOffset > 100) {
				nav.classList.add('bg-dark','shadow');
			}else{
				nav.classList.remove('bg-dark','shadow');
			}
		});
	</script>
	<!-- <script type="text/javascript">
		$(window).scroll(function(){
			var scroll = $(window).scrollTop();
			$('.banner-image').css({
				filter: "blur("+ (scroll/50) +"px)"
			})
		})
	</script> -->
</body>
</html>