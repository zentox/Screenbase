<?php header( 'content-type: text/html; charset=utf-8' );

require_once 'modele/globals.php';
require_once 'modele/database.php';
require_once 'modele/requetes.php';

dbConnect();

$autofocus = false;

if (isset($_GET['random']))
{
	$screens = getAllScreens();
	$allTags = array();

	foreach ($screens as $screen)
	{
		for ($i=0; $i<10; $i++)
		{
			if ($i+1 != 10)
			{
				$index = "tag0";
			}

			else
			{
				$index = "tag";
			}

			$index .= $i+1;

			if ($screen[$index] != null && !in_array($screen[$index], $allTags))
			{
				$allTags[] = $screen[$index];
			}
		}
	}

	$tag = $allTags[rand(0, count($allTags)-1)];
	header ("Location: http://screenbase.byethost16.com/?tag=".$tag);

}

else if (isset($_GET['tag']))
{
	$tag = $_GET['tag'];
}

else if (isset ($_GET['search']))
{
	if ($_GET['search'] != "")
	{
		$tag = $_GET['search'];
		$autofocus = true;
	}

	else
	{
		header('Location: http://screenbase.byethost16.com');
		die;
	}
}

?>


<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="shortcut icon" type="image/png" href="/images/myAvatar.png" />
		<link rel="stylesheet" href="style.css?e=mc2dsdfxcdsed" type="text/css" />
		<title>Screenbase</title>
	</head>
	
	<body>
		<h1 style="font-family:'Courier New'" >Screenbase</h1>

		<p style='margin-top: 30px;'><a href='addscreen.php'>Add a screen</a></p>

		<br>

		<form method='GET' action=''>

			<input type='text' name='search' size='50' autocomplete='off' placeholder=' Search...' required oninvalid='this.setCustomValidity(" ")' oninput='setCustomValidity("")' <?php if ($autofocus){echo "autofocus";} ?>>
			<input type='submit' value='Valider' hidden/>

		</form>

		<table border="0">
			<tr>
				<td>
					<form method='POST' action='/'>
						<input type='submit' value='Home'/>
					</form>
				</td>

				<td>
					<form method='GET' action=''>
						<input type='hidden'  name='random' value='true'>
						<input type='submit' value='Random'/>
					</form>
				</td>
			</tr>
		</table>

		<br><br>

	<?php

	if (isset($tag))
	{
		if ($tag != "")
		{
			$tagSearch = addslashes($tag);
			$screens = getScreensFromTag($tagSearch);
	
			$nbScreens = count($screens);
			$s = "";

			if ($nbScreens > 1)
			{
				$s = "s";
			}

			if (isset($_GET['search']))
			{
				echo "<font size='4'> Search for \"<b>".$tag."</b>\" (".$nbScreens." result".$s.")";
			}

			else
			{
				echo "<font size='4'> Tag \"<b>".$tag."</b>\" (".$nbScreens." result".$s.")";
			}
			
			echo "<br>";

	
			if ($screens != null)
			{
				foreach ($screens as $screen)
				{
					screenDisplay($screen, $tag);
				}
			}
		}
	}

	else
	{
		echo "<font size='4'><b>Last screen added :</b></font>";

		$screenArr = getLastScreen();
		$screen = $screenArr[0];
		screenDisplayNoTag($screen);
	}

	function screenDisplay($screen, $tag) // Fonction principale d'affichage des tags et du screen
	{
		$showTags = "<br><p>&nbsp;";

		for ($i=0; $i<10; $i++) // On parcourt les 10 potentiels tags
		{
			if ($i+1 != 10) // Si index de 1 à 9 on rajoute 0 pour avoir un index à deux chiffres
			{
				$index = "tag0";
			}

			else // Si l'index est 10 pas besoin
			{
				$index = "tag";
			}

			$index .= $i+1; // On obtient l'index du tag courant

			if ($screen[$index] != null) // Si le tag courant n'est pas null on le traite
			{
				$screenTag = $screen[$index]; // Nouvelle variable pour l'index du tag courant
				$screenTagSA = removeAccents($screenTag); // Appel de fonction pour récupérer le tag courant sans accens
				$tag = removeAccents($tag); // Chaine recherchée sans accens

				if ($i != 0)
				{
					$showTags .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				}

				$showTags .= "<a class='tag' href='http://screenbase.byethost16.com?tag=".$screenTag."'>"; // Les tags affichés sont des liens pour faire une recherche sur ces tags

				$tagFound = stripos($screenTagSA, $tag); // On regarde si la chaine recherchée a au moins une occurence dans le tag courant

				if ($tagFound !== false) // Si oui on parcours le tag courant pour afficher en rouge toutes les occurences de la chaine recherchée
				{
					$occs = mb_substr_count(strtoupper($screenTagSA), strtoupper($tag)); // Nombre d'occurence de la chaine recherchée dans le tag courant, insensible à la casse
					$screenTagSize = count($screenTagSA); // Longueur du tag courant
					$tagSize = strlen($tag); // Longueur de la chaine recherchée
					$cursor = 0; // Initialisation du curseur pour le parcours du tag courant

					for ($j=0; $j<$occs; $j++) // Pour chaque occurence de la chaine recherchée
					{
						$pos = stripos(mb_substr($screenTagSA, $cursor), $tag); // Position de la prochaine occurence à partir du curseur
						$showTags .= mb_substr($screenTag, $cursor, $pos); // On affiche le texte allant du curseur à la prochaine occurence en police normale
						$showTags .= "<b>".mb_substr($screenTag, $pos+$cursor, $tagSize)."</b>"; // On affiche l'occurence en rouge
						$cursor += $pos + $tagSize; // On valorise le curseur juste après la position de l'occurence + sa taille
					}

					$showTags .= mb_substr($screenTag, $cursor); // On affiche de reste de la chaine
				}

				else // Sinon on affiche simplement le tag courant
				{
					$showTags .= $screenTag; 
				}

				$showTags .= "</a>"; // On ferme la déclaration du lien
			}
		}

		$showTags .= "</p>";

		echo $showTags;

		echo "<a href='".$screen['url']."' target='_blank'><img src='".$screen['url']."' alt='".$screen['url']."' style='max-width:65%;' border='0'></a><br><br>"; // Affichage de l'image
	}

	function screenDisplayNoTag($screen) // Fonction d'affichage des tags et du screen pour un affichage sans recherche de chaine
	{
		$showTags = "<br><br><p>&nbsp;";

		for ($i=0; $i<10; $i++)
		{
			if ($i+1 != 10)
			{
				$index = "tag0";
			}

			else
			{
				$index = "tag";
			}

			$index .= $i+1;

			if ($screen[$index] != null)
			{
				$screenTag = $screen[$index];

				if ($i != 0)
				{
					$showTags .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				}

				$showTags .= "<a class='tag' href='http://screenbase.byethost16.com?tag=".$screenTag."'>".$screenTag."</a>";
			}
		}

		$showTags .= "</p>";

		echo $showTags;

		echo "<a href='".$screen['url']."' target='_blank'><img src='".$screen['url']."' alt='".$screen['url']."' style='max-width:65%;' border='0'></a><br><br>";
	}

	function removeAccents($str, $charset='utf-8')
	{
		$str = htmlentities($str, ENT_NOQUOTES, $charset);
		
		$str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
		$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
		$str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
		
		return $str;
	}

	?>

	</body>
</html>