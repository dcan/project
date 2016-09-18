<?php

session_start();

if(!empty($_POST['author']) && !empty($_POST['links']) && !empty($_POST['keywords']) && !empty($_POST['content'])) {
	
	$author = htmlspecialchars($_POST['author']);
	$links = htmlspecialchars($_POST['links']);
	$keywords = htmlspecialchars($_POST['keywords']);
	$content = htmlspecialchars($_POST['content']);


	//Gestion du nom de l'auteur
	$author = strtolower($author);
	$tab_author = explode(" ", $author);
	$tab_def = [];
	$inc = 0;

	foreach ($tab_author as $value) {
		$tab_def[$inc] = ucfirst($value);
		$inc++;
	}

	$author = implode(" ", $tab_def);
	//Fin


	//Gestion des links
	$tab_links = explode(",", $links);
	foreach ($tab_links as $value) {
		if (!preg_match("%^((https?://)|(www\.))([a-z0-9-].?)+(:[0-9]+)?(/.*)?$%i", $value)) {
			$_SESSION['error'] = "url";
			session_regenerate_id();
			header('Location: article.php');
		}
	}
	//Fin
	
	//Gestion des keywords
	$keywords = strtolower($keywords);
	//Fin

	try {
		$bdd = new PDO('mysql:host=localhost;dbname=progective', 'root', '');
	} catch (Exception $e) {
		$_SESSION['error'] = "bdd";
		session_regenerate_id();
		header('Location: article.php');
	}

	$requete = $bdd->prepare("INSERT INTO blog(links, author, keywords, content) VALUES(:links, :author, :keywords, :content)");
	$requete->execute(array('links' => $links, 'author' => $author, 'keywords' => $keywords, 'content' => $content));

	if ($requete) {
		$_SESSION['error'] = "allok";
		session_regenerate_id();
		header('Location: article.php');
	} else {
		$_SESSION['error'] = "bdd";
		session_regenerate_id();
		header('Location: article.php');
	}

} else {
	$_SESSION['error'] = "empty";
	session_regenerate_id();
	header('Location: article.php');
}

?>