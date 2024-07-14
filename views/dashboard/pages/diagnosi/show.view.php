<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>

<main class="diagnosiTable">

	<?php if (!isset($diagnosiId)) : ?>
		<h2 class="errorTitle">Non hai richiesto alcuna diagnosi!</h2>		
	<?php elseif (count($diagnosiData) === 0) : ?>
		<h2 class="errorTitle">La diagnosi richiesta non esiste</h2>
	<?php else: ?>
		<h2><b>Codice Diagnosi</b>: <?= $diagnosiData['Codice_Diagnosi'] ?></h2>
		<h2><b>Codice Scheda</b>: <a href="/wildlife/controllers/dashboard/schede/show.php?id=<?= $diagnosiData['Codice_Scheda'] ?>"><?= $diagnosiData['Codice_Scheda'] ?></a></h2>
		<h2><b>Stato Epidermico</b>: <?= $diagnosiData['Stato_Epidermico'] ?></h2>
		<h2><b>Stato Sensorio</b>: <?= $diagnosiData['Stato_Sensorio'] ?></h2>
		<h2><b>Temperatura Corporea</b>: <?= $diagnosiData['Temperatura'] ?>°C</h2>
		<h2><b>Note</b>:<br> <?= $diagnosiData['Note'] ?></h2>

		<br><br><br>
		<h2><b>Operatore</b>: <a href="/wildlife/controllers/dashboard/veterinari/show.php?id=<?= $diagnosiData['Codice_Operatore'] ?>"><?= $diagnosiData['Operatore'] ?></a></h2>

		<br>
	<?php endif; ?>

</main>

<?php include_once($path . 'foot.php'); ?>
