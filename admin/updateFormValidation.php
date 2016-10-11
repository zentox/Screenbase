<?php

require_once '../modele/globals.php';
require_once '../modele/database.php';
require_once '../modele/requetes.php';

$link = dbConnect();

?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="shortcut icon" type="image/png" href="/images/myAvatar.png" />
		<title>Screenbase Admin - Modifier un screen</title>
	</head>

	<body style="margin-left:15px; margin-top:15px;">

		<?php

		$size = getimagesize($_POST['url']);

		if ($size != false)
		{
			$existing = getOthersScreensFromUrl(mysqli_real_escape_string($link, $_POST['url']), mysqli_real_escape_string($link, $_POST['id']));

			if ($existing == null)
			{
				if (updateScreen($_POST['id'], $_POST['url'], $_POST['tag01'], $_POST['tag02'], $_POST['tag03'], $_POST['tag04'], $_POST['tag05'], $_POST['tag06'], $_POST['tag07'], $_POST['tag08'], $_POST['tag09'], $_POST['tag10']))
				{
					echo "<p>Modifications enregistrées.</p>";
					echo "<a href='admin.php'>Suivant</a>";
				}
	
				else
				{
					echo "<p>L'update a échouée.</p>";
					echo "<a href='admin.php'>Suivant</a>";
				}
			}

			else
			{
				echo "<p>Cette image existe déjà.</p>";
				echo "<a href='admin.php'>Suivant</a>";
			}

		}

		else
		{
			echo "<p>L'URL ne pointe pas sur une image.</p>";
			echo "<a href='admin.php'>Suivant</a>";
		}


		?>

	</body>
</html>