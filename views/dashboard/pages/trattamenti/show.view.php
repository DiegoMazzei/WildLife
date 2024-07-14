<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>

<main class="schedaTrattamento">

	<?php if (!isset($idTrattamento)) : ?>
		<h2 class="errorTitle">Non hai richiesto alcun Trattamento!</h1>		
	<?php elseif (count($trattData) === 0) : ?>
		<h2 class="errorTitle">Il trattamento richiesto non esiste</h1>		
	<?php else: ?>
        <h2><b>Codice Trattamento</b>: <?= $idTrattamento ?></h2>
		<h2><b>Codice Operatore</b>: <?= $trattData['Cod_Operatore'] ?></h2>
		<h2><b>Data Trattamento</b>: <?= $trattData['Data_Trattamento'] ?></h2>
		<h2><b>Note</b>: <?= $trattData['Note'] ?></h2>

	<?php endif; ?>

</main>

<?php include_once($path . 'foot.php'); ?>


