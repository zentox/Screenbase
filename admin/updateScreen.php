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

		<h3>Screen base admin - Modifier un screen</h3>

		<?php

		$screens = getScreensFromId($_POST['idScreen']);
		$screen = $screens[0];

		?>

		<form method='POST' action='updateFormValidation.php'>

			<table>
				<tr>
					<td><p style='margin-bottom:10px;'>Lien</p></td>
					<td><input type='text' name='url' size='60' autocomplete='off' required='required' style='margin-bottom:10px;' value='<?php echo $screen["url"]; ?>'></td>
				</tr>
				<tr>
					<td>Tag 1</td>
					<td><input type='text' name='tag01' size='30' autocomplete='off' required='required' value='<?php echo $screen["tag01"]; ?>'></td>
				</tr>
				<tr>
					<td>Tag 2</td>
					<td><input type='text' name='tag02' size='30' autocomplete='off' value='<?php echo $screen["tag02"]; ?>'></td>
				</tr>
				<tr>
					<td>Tag 3</td>
					<td><input type='text' name='tag03' size='30' autocomplete='off' value='<?php echo $screen["tag03"]; ?>'></td>
				</tr>
				<tr>
					<td>Tag 4</td>
					<td><input type='text' name='tag04' size='30' autocomplete='off' value='<?php echo $screen["tag04"]; ?>'></td>
				</tr>
				<tr>
					<td>Tag 5</td>
					<td><input type='text' name='tag05' size='30' autocomplete='off' value='<?php echo $screen["tag05"]; ?>'></td>
				</tr>
				<tr>
					<td>Tag 6</td>
					<td><input type='text' name='tag06' size='30' autocomplete='off' value='<?php echo $screen["tag06"]; ?>'></td>
				</tr>
				<tr>
					<td>Tag 7</td>
					<td><input type='text' name='tag07' size='30' autocomplete='off' value='<?php echo $screen["tag07"]; ?>'></td>
				</tr>
				<tr>
					<td>Tag 8</td>
					<td><input type='text' name='tag08' size='30' autocomplete='off' value='<?php echo $screen["tag08"]; ?>'></td>
				</tr>
				<tr>
					<td>Tag 9</td>
					<td><input type='text' name='tag09' size='30' autocomplete='off' value='<?php echo $screen["tag09"]; ?>'></td>
				</tr>
				<tr>
					<td>Tag 10</td>
					<td><input type='text' name='tag10' size='30' autocomplete='off' value='<?php echo $screen["tag10"]; ?>'></td>
				</tr>
			</table>
		
			<br>
			<input type='hidden' name='id' value='<?php echo $_POST['idScreen']; ?>'>
			<input type='submit' name='submitUpdateForm' value='Valider'/>
		
		</form>

	</body>
</html>