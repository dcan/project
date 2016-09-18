<?php
	echo "Veuillez entrer le mot de passe pour entrer sur la partie admin";
	echo "<form action='' method='POST'><input type='password' placeholder='password'name='password'/><br /><input type='submit' value='Entrer' /></form> ";

	if(!empty($_POST['password'])) {
		$password = htmlspecialchars($_POST['password']);

		if ($password == "test") {
			session_start();
			$_SESSION['access'] = "ok";
			session_regenerate_id();
			header('Location: article.php');
		}
	}
	//aRt-54*%87uiPO^Uk2
?>