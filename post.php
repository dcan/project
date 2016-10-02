<?php

	function getPost ($id) {

		//Connexion à la bdd
		try {
			$bdd = new PDO('mysql:host=localhost;dbname=progective', 'root', '');
		} catch (Exception $e) {
			die("Error !");
		}
		//Fin

		$daterequest = $bdd->prepare("SELECT date FROM blog WHERE id = :id");
		$daterequest->execute(array('id' => $id));
		$datework = $daterequest->fetch(PDO::FETCH_COLUMN, 0);
		list($date1, $time) = explode(" ", $datework);
		list($year, $month, $day) = explode("-", $date1);
		list($hour, $min, $sec) = explode(":", $time);
		$date = "$day/$month/$year";


		$linksrequest = $bdd->prepare("SELECT links FROM blog WHERE id = :id");
		$linksrequest->execute(array('id' => $id));
		$links = $linksrequest->fetch(PDO::FETCH_COLUMN, 0);

		$authorrequest = $bdd->prepare("SELECT author FROM blog WHERE id = :id");
		$authorrequest->execute(array('id' => $id));
		$author = $authorrequest->fetch(PDO::FETCH_COLUMN, 0);

		$keysrequest = $bdd->prepare("SELECT keys FROM blog WHERE id = :id");
		$keysrequest->execute(array('id' => $id));
		$keys = $keysrequest->fetch(PDO::FETCH_COLUMN, 0);

		$contentrequest = $bdd->prepare("SELECT content FROM blog WHERE id = :id");
		$contentrequest->execute(array('id' => $id));
		$content = $contentrequest->fetch(PDO::FETCH_COLUMN, 0);

		$titlerequest = $bdd->prepare("SELECT title FROM blog WHERE id = :id");
		$titlerequest->execute(array('id' => $id));
		$title = $titlerequest->fetch(PDO::FETCH_COLUMN, 0);

		return(array('date' => $date, 'links' => $links, 'author' => $author, 'keys' => $keys, 'content' => $content, 'title' => $title));
	}


?>