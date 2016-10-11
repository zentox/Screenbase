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
		<link rel="stylesheet" href="style.css?e=mc2dsdfxcded" type="text/css" />
		<title>Screenbase</title>
	</head>
	
	<body>
		<h1 style="font-family:'Courier New'" >Screenbase</h1>

		<a href='addscreen.php'><p style='margin-top: 35px;'>Ajouter un screen</p></a>

		<br>

		<form method='GET' action=''>

			<input type='text' name='search' size='50' autocomplete='off' placeholder=' Rechercher...' <?php if ($autofocus){echo "autofocus";} ?>>
			<input type='submit' value='Valider' hidden/>

		</form>

		<form method='GET' action=''>

			<input type='hidden'  name='random' value='true'>
			<br>
			<input type='submit' value='Random tag'/>

		</form>


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

			echo "<font size='4'> Recherche de \"<b>".$tag."</b>\" (".$nbScreens." résultat".$s.")";

	
			if ($screens != null)
			{
				foreach ($screens as $screen)
				{
					$showTags = "<br><br><br><p>&nbsp;";
	
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
							var_dump($screenTag);
							$screenTagSA = removeAccents($screenTag);
							var_dump($screenTagSA);
							$tag = removeAccents($tag);

							if ($i != 0)
							{
								$showTags .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
							}
	
							$showTags .= "<a class='tag' href='http://screenbase.byethost16.com?tag=".$screenTag."'>";

							$tagFound = stripos($screenTagSA, $tag);

							if ($tagFound !== false)
							{
								$occs = mb_substr_count(strtoupper($screenTagSA), strtoupper($tag));
								$screenTagSize = count($screenTagSA);
								$tagSize = strlen($tag);
								$cursor = 0;

								for ($j=0; $j<$occs; $j++)
								{
									$pos = stripos(mb_substr($screenTagSA, $cursor), $tag);
									$showTags .= mb_substr($screenTag, $cursor, $pos);
									$showTags .= "<font color='#EC0000'>".mb_substr($screenTag, $pos+$cursor, $tagSize)."</font>";
									$cursor += $pos + $tagSize;
								}

								$showTags .= mb_substr($screenTag, $cursor);
							}

							else
							{
								$showTags .= $screenTag;
							}

							$showTags .= "</a>";
						}
					}
	
					$showTags .= "</p>";
	
					echo $showTags;

					echo "<a href='".$screen['url']."' target='_blank'><img src='".$screen['url']."' alt='".$screen['url']."' style='max-width:65%;' border='0'></a><br><br>";
				}
			}
		}
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