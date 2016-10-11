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
		<title>Screenbase Admin</title>
	</head>

	<body style="margin-left:25px; margin-top:25px;">

		<h3>Screenbase admin</h3>

		<?php

		if (isset($_POST['deleteScreen']))
		{
			deleteScreen($_POST['idScreen']);
			header ("Location: http://screenbase.byethost16.com/admin/admin.php");
		}

		$screens = getAllScreens();

		if ($screens != null)
		{
			echo "<br>".count($screens)." résultats<br><br>";

			foreach ($screens as $screen)
			{
				echo "<br>";

				if ($screen['insertDate'] != null)
				{
					$date = date_format(date_create($screen['insertDate']),'d/m/Y H:i:s');
					echo "<p>".$date."</p>";
				}

				if ($screen['ip'] != null)
				{
					echo "<p>IP : ".$screen['ip']."</p>";
				}

				$showTags = "<p> Tags : ";

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
						if ($i != 0)
						{
							$showTags .= "&nbsp;&nbsp;&nbsp;";
						}

						$showTags .= $screen[$index];
					}
				}

				$showTags .= "</p>";

				echo $showTags;

				echo "<a href='".$screen['url']."' target='_blank'><img src='".$screen['url']."' alt='".$screen['url']."' style='max-width:40%;' border='0'></a><br><br>";
				
				?>

				<form method='POST' action='updateScreen.php'>
					<input type='hidden' name='idScreen' value='<?php echo $screen["id"]; ?>'>
					<input type='submit' value='Modifier' name='updateScreen'>
				</form>

				<form method='POST' action=''>
					<input type='hidden' name='idScreen' value='<?php echo $screen["id"]; ?>'>
					<input type='submit' value='Supprimer' name='deleteScreen' onclick='return confirm("Supprimer ?")'>
				</form>

				<?php
			}
		}

		else
		{
			echo "Aucun résultat.";
		}

		?>

	</body>
</html>