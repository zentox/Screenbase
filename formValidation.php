<?php

require_once 'modele/globals.php';
require_once 'modele/database.php';
require_once 'modele/requetes.php';

$link = dbConnect();

date_default_timezone_set('Europe/Paris');

?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="shortcut icon" type="image/png" href="/images/myAvatar.png" />
		<link rel="stylesheet" href="style.css?e=mc2dsdfxcded" type="text/css" />
		<title>Screenbase - Add screen</title>
	</head>

	<body>

		<?php

		$size = getimagesize($_POST['url']);

		if ($size != false)
		{
			$existing = getScreensFromUrl(mysqli_real_escape_string($link, $_POST['url']));

			if ($existing == null)
			{
				$ip = $_SERVER["REMOTE_ADDR"];
				$nav = $_SERVER["HTTP_USER_AGENT"];
				$date = date("Y-m-d H:i:s");

				if ($ip == false)
				{
					$ip = "";
				}
				
				if ($nav == false)
				{
					$nav = "";
				}

				if (addScreen($_POST['url'], $date, $ip, $nav, $_POST['tag01'], $_POST['tag02'], $_POST['tag03'], $_POST['tag04'], $_POST['tag05'], $_POST['tag06'], $_POST['tag07'], $_POST['tag08'], $_POST['tag09'], $_POST['tag10']))
				{
					echo "<p>Screen added successfully</p>";
					echo "<a href='/'>Home</a>";
					echo "&nbsp;&nbsp;<a href='addscreen.php'>Add another screen</a>";
				}
	
				else
				{
					echo $date;
					echo "<p>Something wrong happened. Please try again</p>";
					echo "<a href='/'>Home</a>";
					echo "&nbsp;&nbsp;<a href='addscreen.php'>Try again</a>";
				}
			}

			else
			{
				echo "<p>This screen already exists</p>";
				echo "<a href='/'>Home</a>";
				echo "&nbsp;&nbsp;<a href='addscreen.php'>Try again</a>";
			}

		}

		else
		{
			echo "<p>The link is not targetting on a image. You need to see image's name and extention at the end of the link to ensure that it is targetting on the image.</p>";
			echo "<a href='/'>Home</a>";
			echo "&nbsp;&nbsp;<a href='addscreen.php'>Try again</a>";
		}


		?>

	</body>
</html>