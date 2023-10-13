
<?php 

include './includes/header.php';

?>

<body class="dashboard">

	<!-- SIDEBAR -->
	<?php include './includes/sideNav.php'; ?>
	
	<!-- SIDEBAR -->
	
	
	
	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<?php include './includes/topNav.php'; ?>
		
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-book' ></i>
					<span class="text">
						<h3>1020</h3>
						<p>Lessons</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">
						<h3>9</h3>
						<p>Categories</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-user' ></i>
					<span class="text">
						<h3>123</h3>
						<p>Total Users</p>
					</span>
				</li>
			</ul>
		</main>
		<!-- MAIN -->
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="./assets2/script.js"></script>
	<script src="./assets2/nav-magic.js"></script>
</body>
</html>