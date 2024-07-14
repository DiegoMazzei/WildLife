<?php
	
	$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
	require ($root . 'database.php');
	require ($root . 'functions/utility.php');

		/* case 'Chirurgica':
			break;
		case 'Riabilitativa':
			break;
	} */
?>

<?php if ($_SERVER['REQUEST_METHOD'] && $_POST['tipologia']) : ?>
	<?php
	$tipologieQuery = "SELECT Descrizione FROM tipologia_terapia WHERE Codice_Terapia = " . $_POST['tipologia'] . ";";
	$tipologieData = queryOneAssoc($tipologieQuery, $connection);
	$tipologia = $tipologieData['Descrizione'];
	?>
	
	<!-- Form Terapia Farmacologica -->
	<?php if ($tipologia === 'Farmacologica/Medicale') : ?>

		<?php
		$farmaciQuery = "SELECT DISTINCT Codice_farmaco, MEDICINALE_VETERINARIO from farmaci";
		$farmaciData = queryAllAssoc($farmaciQuery, $connection);
		?>

		<h1>Dati Terapia Farmacologica</h1>

		<label for="farmaci">Farmaci</label>
		<select class="form-select" name="codiceFarmaco" id="farmaci">
		    <option value=""> Seleziona il farmaco </option>
		    <?php foreach ($farmaciData as $record) : ?>
				<option value="<?php echo $record['Codice_farmaco']; ?>"><?= $record['MEDICINALE_VETERINARIO'] ?></option>
		    <?php endforeach; ?>
		</select><br><br>

		<label for="posologia">Posologia:</label><br>
		<textarea id="posologia" name="posologia" required></textarea><br><br>

		<label for="frequenza">Frequenza:</label><br>
		<input type="text" id="frequenza" name="frequenza" required></textarea><br><br>

		<label for="durata">Durata:</label><br>
		<input type="text" id="durata" name="durata" required></textarea><br><br>

		<label for="dataInizio">Data Inizio:</label><br>
		<input type="date" id="dataInizio" name="dataInizio" required></input><br><br>

		<label for="note">Note:</label><br>
		<textarea id="note" name="note" required></textarea><br><br>

	<!-- Form Terapia Chirurgica -->
	<?php elseif($tipologia === 'Chirurgica'): ?>

		<h1>Dati Terapia Chirurgica</h1>
		<label for="descrizioneChirurgica">Descrizione:</label><br>
		<textarea id="descrizioneChirurgica" name="descrizioneChirurgica" required></textarea><br><br>

		<label for="stato">Stato:</label>
		<!--<input min=0 max=1 type="number" id="stato" name="stato" required><br><br>-->
		<select class='form-select' name='stato' id='stato'>
		    <option value="">Seleziona lo Stato della Terapia</option>
		    <option value="1">Compiuta</option>
		    <option value="0">Non Compiuta</option>
		</select><br><br>

		<label for="durata">Durata:</label><br>
		<input type="time" id="durata" name="durata" required></input><br>

		<label for="dataOperazione">Data Operazione:</label><br>
		<input type="date" id="dataOperazione" name="dataOperazione" required></input><br><br>

		<label for="esito">Esito:</label><br>
		<textarea id="esito" name="esito" required></textarea><br><br>

		<label for="note">Note:</label><br>
		<textarea id="note" name="note" required></textarea><br><br>

			
	<!-- Form Terapia Riabilitativa -->
	<?php elseif($tipologia === 'Riabilitativa'): ?>

		<h1>Dati Terapia Riabilitativa</h1>

		<label for="descrizioneRiabilitativa">Descrizione:</label><br>
		<textarea id="descrizioneRiabilitativa" name="descrizioneRiabilitativa" required></textarea><br><br>

		<label for="frequenza">Frequenza:</label><br>
		<input type="text" id="frequenza" name="frequenza" required></textarea><br><br>

		<label for="durata">Durata:</label><br>
		<input type="text" id="durata" name="durata" required></textarea><br><br>
				
	<?php endif; ?>
<?php endif; ?>
