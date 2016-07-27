<?php header( 'content-type: text/html; charset=utf-8' );

require_once 'modele/globals.php';
require_once 'modele/database.php';
require_once 'modele/requetes.php';

dbConnect();

	if (isset($_GET['tag']))
	{
		$_POST['tag'] = $_GET['tag'];
		$autofocus = false;
	}

	else
	{
		$autofocus = true;
	}

?>


<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="shortcut icon" type="image/png" href="/images/myAvatar.png" />
		<title>Screenbase</title>
	</head>
	
	<body style="margin-left:25px; margin-top:25px;">
		<h2>Screenbase</h2>
		<br>
		<form method='POST' action='http://screenbase.byethost16.com/'>

			<input type='text' name='tag' size='50' autocomplete='off' placeholder=' Rechercher...' <?php if ($autofocus){echo "autofocus";} ?>>
			<input type='submit' name='submitSearch' value='Valider' hidden/>
			<br><br>
			<a href='addscreen.php'>Ajouter un screen</a>

		</form>

	<?php

	if (isset($_POST['tag']))
	{
		if ($_POST['tag'] != "")
		{

			$tag = addslashes($_POST['tag']);
			$screens = getScreensFromTag($tag);
	
			echo "<br><font size='4'>Recherche sur <b>".$tag."</b> (".count($screens)." résultat(s))</font>";
	
			if ($screens != null)
			{
				foreach ($screens as $screen)
				{
					$showTags = "<br><br><p>";
	
					for ($i=0; $i<10; $i++)
					{
						if ($i != 10)
						{
							$index = "tag0";
						}

						else
						{
							$index = "tag0";

						}
						$index .= $i+1;
	
						if ($screen[$index] != null)
						{
							if ($i != 0)
							{
								$showTags .= "&nbsp;&nbsp;&nbsp;";
							}
	
							$showTags .= "<a href='http://screenbase.byethost16.com?tag=".$screen[$index]."'>".$screen[$index]."</a>";
						}
					}
	
					$showTags .= "</p>";
	
					echo $showTags;
					echo "<a href='".$screen['url']."' target='_blank'><img src='".$screen['url']."' alt='".$screen['url']."' style='max-width:65%;' border='0'></a><br><br>";
				}
			}
		}
	}

	?>

	</body>
</html>