<?php 
session_start();
//Connexion à la bdd
try {
	$bdd2 = new PDO('mysql:host=localhost;dbname=progective', 'root', '');
} catch (Exception $e) {
	die("Error !");
}
//Fin

$rqtIdMax = $bdd2->prepare("SELECT MAX(id) AS idmax FROM blog");
$rqtIdMax->execute();
$row = $rqtIdMax->fetch();
$idmax = $row['idmax'];


require('post.php'); 
$post = getPost($_GET['id']);

$date = $post['date'];
$links = $post['links'];
$author = $post['author'];
$keywords = $post['keys'];
$content = $post['content'];
$title = $post['title'];

if(empty($_SESSION['order'])) {
	$order = $_GET['id'];
	if ($order > 1) {
		$moins = $order - 1;
	} else {
		$moins = $order;
	}
	if ($order < $idmax) {
		$plus = $order + 1;
	} else {
		$plus = $order;
	}
} else {
	if(!isset($_SESSION['followOrder'])) {
		$_SESSION['followOrder'] = 0;
	} else {
		$order = $_SESSION['order'][$_SESSION['followOrder']];

		if (!empty($_SESSION['followOrder']) &&  $_SESSION['followOrder'] < count($_SESSION['order'])) {
			$_SESSION['followOrder'] += 1;
			$plus = $_SESSION['order'][$_SESSION['followOrder']];
		} else {
			$plus = $_SESSION['order'][$_SESSION['followOrder']];
		}

		if (!empty($_SESSION['followOrder']) &&  $_SESSION['followOrder'] > 0) {
			$_SESSION['followOrder'] -= 1;
			$moins = $_SESSION['order'][$_SESSION['followOrder']];
		} else {
			$moins = $_SESSION['order'][$_SESSION['followOrder']];
		}
	}
}
?>
<!Doctype html>
<html>
	<head>
		<title>proGective</title>
		<meta charset="UTF-8" />
		<meta name="author" content="Diyar Can" />
		<link rel="stylesheet" href="assets/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/css/add.css" />
		<script type="text/javascript" src="assets/js/bootsrap.js"></script>
		<script type="text/javascript" src="jquery-1.12.4.min.js"></script>
	</head>

	<body>

		<!-- Navbar -->
		<nav class="navbar navbar-default">
		  <div class="container">

		   	<div class="navbar-header">
		   		<a class="navbar-brand" href="/">
		   			proGective
		   		</a>
		   	</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			   	<ul class="nav navbar-nav">
			   		<li><a href="/">À propos</a></li>
			   		<li><a href="ressources">Ressources</a></li>
			   		<li class="active"><a href="">Blog</a></li>
			   		<li><a href="#">Contact</a></li>
			   	</ul>
			</div>

		  </div>
		</nav>
		<!-- Fin navbar -->
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-9"></div>
				<div class="col-xs-6 col-md-3">
					<form role="form" method="POST" action="search.php" > 
					  <div class="form-group has-feedback has-feedback-left">
					    <input type="text" class="form-control" placeholder="Search" name="search" />
					    <i class="form-control-feedback glyphicon glyphicon-search"></i>
					  </div>
					</form>
				</div>
			</div>

			<div class="row">
				<div class="col-md-9">
					<div class="well well-lg">
						<div class="page-header">
							<div class="row">
								<div class="col-md-10"><h1><?php echo $title; ?> <small>by <?php echo $author; ?></small></h1></div>
								<div class="col-md-2"><h4><small><?php echo $date; ?></small></h4></div>
							</div>
						</div>
						<p><?php echo $content; ?></p>
					</div>
				</div>
			</div>

			<nav aria-label="...">
			  <ul class="pager">
			    <li><a href="blog.php?id=<?php echo $moins;?>">Previous</a></li>
			    <li><a href="blog.php?id=<?php echo $plus;?>">Next</a></li>
			  </ul>
			</nav>
		</div>

	</body>

</html>