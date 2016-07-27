<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="shortcut icon" type="image/png" href="/images/myAvatar.png" />
		<title>Screenbase - Ajouter un screen</title>
	</head>

	<body style="margin-left:15px; margin-top:15px;">

		<h3>Ajouter un screen</h3>

		<p>Hebergez votre image sur un site d'hébergement gratuit comme <a href='http://www.hostingpics.net/' target='_blank'>hostingpics</a> puis collez le lien ci-dessous :</p>

		<form method='POST' action='formValidation.php'>

			<table>
				<tr>
					<td><p style='margin-bottom:10px;'>Lien</p></td>
					<td><input type='text' name='url' size='60' autocomplete='off' required='required' style='margin-bottom:10px;'></td>
				</tr>
				<tr>
					<td colspan='2'><p style='color:grey; margin-bottom:10px;'><i>Renseignez au moins un tag</i></p></td>
				</tr>
				<tr>
					<td>Tag 1&nbsp;</td>
					<td><input type='text' name='tag01' size='30' autocomplete='off' required='required'></td>
				</tr>
				<tr>
					<td>Tag 2</td>
					<td><input type='text' name='tag02' size='30' autocomplete='off'></td>
				</tr>
				<tr>
					<td>Tag 3</td>
					<td><input type='text' name='tag03' size='30' autocomplete='off'></td>
				</tr>
				<tr>
					<td>Tag 4</td>
					<td><input type='text' name='tag04' size='30' autocomplete='off'></td>
				</tr>
				<tr>
					<td>Tag 5</td>
					<td><input type='text' name='tag05' size='30' autocomplete='off'></td>
				</tr>
				<tr>
					<td>Tag 6</td>
					<td><input type='text' name='tag06' size='30' autocomplete='off'></td>
				</tr>
				<tr>
					<td>Tag 7</td>
					<td><input type='text' name='tag07' size='30' autocomplete='off'></td>
				</tr>
				<tr>
					<td>Tag 8</td>
					<td><input type='text' name='tag08' size='30' autocomplete='off'></td>
				</tr>
				<tr>
					<td>Tag 9</td>
					<td><input type='text' name='tag09' size='30' autocomplete='off'></td>
				</tr>
				<tr>
					<td>Tag 10</td>
					<td><input type='text' name='tag10' size='30' autocomplete='off'></td>
				</tr>
			</table>
		
			<br>
			<input type='submit' name='submitAddForm' value='Ajouter'/>
		
		</form>

		<a href='/'>Annuler</a>

	</body>
</html>