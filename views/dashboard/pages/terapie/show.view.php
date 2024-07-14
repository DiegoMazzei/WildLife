<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>

<main class="terapiaVeterinario">

	<?php if (!isset($idTerapia)) : ?>
		<h2 class="errorTitle">Non hai richiesto alcun terapia!</h1>		
	<?php elseif (count($terapiaData) === 0) : ?>
		<h2 class="errorTitle">La terapia richiesta non esiste</img>		
	<?php else: ?>
		<h2><b>Codice Terapia</b>: <?= $terapiaData['Codice_Terapia'] ?></h2>
		<h2><b>Codice Diagnosi</b>: <a href="/controllers/dashboard/diagnosi/show.php?id=<?= $terapiaData['Codice_Diagnosi'] ?>"><?= $terapiaData['Codice_Diagnosi'] ?></a></h2>
		<h2><b>Tipologia Terapia</b>: <?= $terapiaData['Tipologia'] ?></h2>
		<h2><b>Descrizione</b>: <?= $terapiaData['Descrizione'] ?></h2>
		<h2><b>Data Compilazione</b>: <?= $terapiaData['Data_compilazione'] ?></h2>
		<h2><b>Registrata da</b>: <?= $terapiaData['Operatore'] ?></h2>
		<br><br><br>

		<?php if (count($terapiaChirurgica)) : ?>

			<h1>Dati Terapia Chirurgica </h1>
			<h2><b>Descrizione</b>: <?= $terapiaChirurgica['Descrizione']?></h2>
			<h2><b>Durata Intervento</b>: <?= $terapiaChirurgica['Durata_Intervento']?></h2>
			<h2><b>Data Intervento</b>: <?= $terapiaChirurgica['Data_Intervento']?></h2>
			<h2><b>Esito Operazione</b>: <?= $terapiaChirurgica['Esito_operazione']?></h2>
			<h2><b>Note</b>: <?= $terapiaChirurgica['Note']?></h2>
			<h2><b>Stato</b>:
			<?php
			    if($terapiaChirurgica['Stato'] == 0) {
			        echo("Non Compiuta");
			    } else {
			        echo("Compiuta");
			    }
			?></h2>

		<?php elseif (count($terapiaFarmacologica)) : ?>

			<h1>Dati Terapia Farmacologica </h1>
			<h2><b>Posologia</b>: <?= $terapiaFarmacologica['Posologia']?></h2>
			<h2><b>Medicinale Prescritto</b>: <?= $terapiaFarmacologica['MEDICINALE_VETERINARIO']?></h2>
			<h2><b>Frequenza</b>: <?= $terapiaFarmacologica['Frequenza']?></h2>
			<h2><b>Durata</b>: <?= $terapiaFarmacologica['Durata']?></h2>
			<h2><b>Data Inizio</b>: <?= $terapiaFarmacologica['Data_Inizio']?></h2>
			<h2><b>Note</b>: <?= $terapiaFarmacologica['Note']?></h2>

		<?php elseif ($terapiaRiabilitativa) : ?>
			<h1>Dati Terapia Riabilitativa </h1>
			<h2><b>Descrizione</b>: <?= $terapiaRiabilitativa['Descrizione']?></h2>
			<h2><b>Frequenza</b>: <?= $terapiaRiabilitativa['Frequenza']?></h2>
			<h2><b>Durata</b>: <?= $terapiaRiabilitativa['Durata']?></h2>
		<?php endif; ?>
		
		<br>
	<?php endif; ?>

</main>

<?php include_once($path . 'foot.php'); ?>
