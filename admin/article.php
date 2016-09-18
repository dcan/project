<?php 
session_start();
$code = "";

$error = "";
$url = "";
$empty = "";
if(!empty($_SESSION['error'])){ $error = $_SESSION['error']; session_unset($_SESSION['error']); }

if($error == "url") {
	$url = "has-error";
} elseif($error == "empty") {
	$empty = "has-error";
} elseif ($error == "bdd") {
	echo "<script type='text/javascript>alert('Error, please try later')</script>";
} elseif ($error == "allok") {
	echo "<div class='alert alert-success' role='alert'>Post envoyé avec succès</div>";
} elseif(empty($_SESSION['access'])) {
	header('Location: secureadmin.php');
} 
?>
<!Doctype html>
<html>
	<head>
		<title>proGective - Admin</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="../assets/css/bootstrap.css" />
	</head>

	<body>
		<h1 style="margin-left:4%;">Admin page <small>- Post an article</small></h1>
		<br /> <br /> <br />
		<div class="container">
			<form class="form-horizontal" action="newarticle.php" method="POST">
			  <div class="form-group <?php echo $empty; ?>">
			    <label for="inputAuthor" class="col-sm-2 control-label">Author</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="inputAuthor" placeholder="ex. Andrew Nelson" name="author">
			    </div>
			  </div>
			  <div class="form-group <?php echo $url; echo $empty; ?>">
			    <label for="inputLinks" class="col-sm-2 control-label">Links</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="inputLinks" placeholder="ex. http://hello.com, http://progective/assets/images/mypng.png" name="links">
			    </div>
			  </div><div class="form-group <?php echo $empty; ?>">
			    <label for="inputKeys" class="col-sm-2 control-label">Keywords</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="inputKeys" placeholder="ex. myArticle, new, technlogy, usa, business" name="keywords">
			    </div>
			  </div>
			  <div class="form-group <?php echo $empty; ?>">
			  	<label for="contentText" class="col-sm-2 control-label">Content</label>
			 	<div class="col-sm-10">
			  		<textarea class="form-control" rows="10" style="resize:none;" id="contentText" name="content"></textarea>
			   	</div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-default" >Post this artcle</button>
			    </div>
			  </div>
			</form>
		</div>
	</body>
</html>
