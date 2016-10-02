<?php

if(!empty($_POST['search'])){

	

	$searchMaterial = htmlspecialchars($_POST['search']);

	$search = explode(" ", $searchMaterial);

	$like = "";

	foreach($search as $keyword) {
        // Je concatène
        // Le % en SQL est un joker, ça remplace n'importe quel caractère. Si tu veux que se soit une recherche explicite retire les %
        $like.= " keywords LIKE '%".$keyword."%' OR";
    }

    // Je retire le dernier OR qui n'a pas lieu d'être
    $like = substr($like, 0, strlen($like) - 3);

    //Connexion à la bdd
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=progective', 'root', '');
	} catch (Exception $e) {
		die("Error !");
	}
	//Fin

    $rqt = $bdd->prepare("SELECT id FROM blog WHERE ".$like);
    $rqt->execute();
    $result = $rqt->fetchAll(PDO::FETCH_COLUMN, 0);

    if(!empty($result)) {

	    session_start();
	    $_SESSION['order'] = $result;
	    $redirecting = $_SESSION['order'][0];
	    session_regenerate_id();

	    header("Location: blog.php?id=$redirecting");
	} else {
		header('Location: blog.php?id=1');
	}

} else {
	header('Location: blog.php?id=1');
}

?>