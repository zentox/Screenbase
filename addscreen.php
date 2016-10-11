<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="shortcut icon" type="image/png" href="/images/myAvatar.png" />
		<link rel="stylesheet" href="style.css?e=mc2dsdfxcded" type="text/css" />
		<title>Screenbase - Ajouter un screen</title>
	</head>

	<body>

		<h1 style="font-family:'Courier New'" >Screenbase</h1>

		<h3 style='margin-top: 25px;margin-bottom:25px;'>Add a screen</h3>

		<p>Host your screen on an image hosting website like <a href='http://www.hostingpics.net/' target='_blank'>hostingpics</a> and get its link, or copy the link of an image on internet, then past it in the link field below.<br>Caution : You need to see image's name and extention at the end of the link to ensure that the link is targetting on the image.</p>

		<form method='POST' action='formValidation.php'>

			<table>
				<tr>
					<td><p style='margin-bottom:10px;'>Link</p></td>
					<td><input type='text' name='url' size='60' autocomplete='off' required='required' style='margin-bottom:10px;'></td>
				</tr>
				<tr>
					<td colspan='2'><p style='color:grey; margin-top:5px; margin-bottom:10px;'><i>Please type at least one tag</i></p></td>
				</tr>
				<tr>
					<td>Tag 1&nbsp;</td>
					<td><input type='text' name='tag01' size='30' autocomplete='off' required='required'  maxlength='32'></td>
				</tr>
				<tr>
					<td>Tag 2</td>
					<td><input type='text' name='tag02' size='30' autocomplete='off' maxlength='32'></td>
				</tr>
				<tr>
					<td>Tag 3</td>
					<td><input type='text' name='tag03' size='30' autocomplete='off' maxlength='32'></td>
				</tr>
				<tr>
					<td>Tag 4</td>
					<td><input type='text' name='tag04' size='30' autocomplete='off' maxlength='32'></td>
				</tr>
				<tr>
					<td>Tag 5</td>
					<td><input type='text' name='tag05' size='30' autocomplete='off' maxlength='32'></td>
				</tr>
				<tr>
					<td>Tag 6</td>
					<td><input type='text' name='tag06' size='30' autocomplete='off' maxlength='32'></td>
				</tr>
				<tr>
					<td>Tag 7</td>
					<td><input type='text' name='tag07' size='30' autocomplete='off' maxlength='32'></td>
				</tr>
				<tr>
					<td>Tag 8</td>
					<td><input type='text' name='tag08' size='30' autocomplete='off' maxlength='32'></td>
				</tr>
				<tr>
					<td>Tag 9</td>
					<td><input type='text' name='tag09' size='30' autocomplete='off' maxlength='32'></td>
				</tr>
				<tr>
					<td>Tag 10</td>
					<td><input type='text' name='tag10' size='30' autocomplete='off' maxlength='32'></td>
				</tr>
			</table>
		
			<input type='submit' name='submitAddForm' value='Submit' style='margin-top:25px;'/>
			&nbsp;&nbsp;<a href='/'>Cancel</a>
		
		</form>

		

	</body>
</html>