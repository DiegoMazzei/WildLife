<?php

require('database.php');

$query = "SELECT DISTINCT regione FROM regprovcomune ORDER BY 1";
$records = $connection -> query($query) -> fetch_all(MYSQLI_ASSOC);

?>

<html>
	<head>
		<title>Selezione Comune</title>

	</head>

	<body>
		<label for="regione">Regione</label>
		<select id="regione" class="regione">
			<option value="" name="regione">Seleziona una regione</option>
			<?php foreach ($records as $record): ?>
				<option value="<?= $record['regione'] ?>"> <?= $record['regione'] ?> </option>
			<?php endforeach ?>
		</select>
		<br>
		<br>

		<label for="provincia">Provincia</label>
		<select id="provincia" class="provincia">
		</select>
		<br>
		<br>

		<label for="comune">Comune</label>
		<select id="comune" class="comune">
		</select>
	</body>
</html>
