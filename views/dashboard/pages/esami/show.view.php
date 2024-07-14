<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>

<main class="esameVeterinario">

	<?php if (!isset($idEsame)) : ?>
		<h2 class="errorTitle">Non hai richiesto alcun esame!</h1>		
	<?php elseif (count($esameData) === 0) : ?>
		<h2 class="errorTitle">L'esame richiesto non esiste</img>		
	<?php else: ?>
		<h2><b>Codice Prescrizione</b>: <?= $esameData['Codice_prescrizione'] ?></h2>
		<h2><b>Codice Diagnosi</b>: <a href="/wildlife/controllers/dashboard/diagnosi/show.php?id=<?= $esameData['Codice_Diagnosi'] ?>"><?= $esameData['Codice_Diagnosi'] ?></a></h2>
		<h2><b>Tipologia Esame</b>: <?= $esameData['Tipologia_esame'] ?></h2>
		<h2><b>Data Prescrizione</b>: <?= $esameData['Data_prescrizione'] ?></h2>
		<h2><b>Stato</b>: <?= $esameData['Stato'] ?></h2>
		<h2><b>Sintesi Esito</b>: <?= $esameData['Sintesi_Esito'] ?></h2>
		<h2><b>Descrizione</b>: <?= $esameData['Descrizione'] ?></h2>

		<!-- <img src="/wildlife/uploads/esami/<?= $imageTimestamp ?>.<?= $imageFiletype ?>"> -->

		<br><br><br>
		<h2><b>Registrato da</b>: <?= $esameData['Operatore'] ?></h2>

		<br>
	<?php endif; ?>

</main>

<?php include_once($path . 'foot.php'); ?>
