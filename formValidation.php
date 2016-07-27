<?php

require_once 'modele/globals.php';
require_once 'modele/database.php';
require_once 'modele/requetes.php';

$link = dbConnect();

?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="shortcut icon" type="image/png" href="/images/myAvatar.png" />
		<title>Screenbase - Ajouter un screen</title>
	</head>

	<body style="margin-left:15px; margin-top:15px;">

		<?php

		$size = getimagesize($_POST['url']);

		if ($size != false)
		{
			$existing = getScreensFromUrl(mysqli_real_escape_string($link, $_POST['url']));

			if ($existing == null)
			{
				$ip = $_SERVER["REMOTE_ADDR"];

				if ($ip == false)
				{
					$ip = "";
				}

				$nav = $_SERVER["HTTP_USER_AGENT"];
				
				if ($nav == false)
				{
					$nav = "";
				}

				if (addScreen($_POST['url'], $ip, $nav, $_POST['tag01'], $_POST['tag02'], $_POST['tag03'], $_POST['tag04'], $_POST['tag05'], $_POST['tag06'], $_POST['tag07'], $_POST['tag08']))
				{
					echo "<p>Image ajoutée avec succès.</p>";
					echo "<a href='/'>Accueil</a>";
					echo "<br><br><a href='addscreen.php'>Ajouter un autre screen</a>";
				}
	
				else
				{
					echo "<p>L'upload a échoué.</p>";
					echo "<a href='/'>Accueil</a>";
					echo "<br><br><a href='addscreen.php'>Réessayer</a>";
				}
			}

			else
			{
				echo "<p>Cette image existe déjà.</p>";
				echo "<a href='/'>Accueil</a>";
				echo "<br><br><a href='addscreen.php'>Réessayer</a>";
			}

		}

		else
		{
			echo "<p>L'URL ne pointe pas sur une image. L'image doit apparaître seule sur la page pour que l'URL soit valide.</p>";
			echo "<a href='/'>Accueil</a>";
			echo "<br><br><a href='addscreen.php'>Réessayer</a>";
		}


		?>

	</body>
</html>