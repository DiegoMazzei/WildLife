<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php require 'permit.php';?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>


<main class="schedaVeterinario">

	<?php if (!isset($idOperatore)) : ?>
		<h2 class="errorTitle">Non hai richiesto alcun operatore!</h1>		
	<?php elseif (count($opData) === 0) : ?>
		<h2 class="errorTitle">l'operatore richiesto non esiste</h1>		
	<?php else: ?>
		<h2><b>Nome</b>: <?= $opData['Nome'] ?></h2>
		<h2><b>Cognome</b>: <?= $opData['Cognome'] ?></h2>
		<h2><b>Indirizzo</b>: <?= $opData['Indirizzo'] ?></h2>
		<h2><b>Comune</b>: <?= $opData['Comune'] ?></h2>
		<h2><b>Telefono</b>: <?= $opData['Telefono'] ?></h2>
		<h2><b>Email</b>: <?= $opData['Email'] ?></h2>
		<h2><b>Username</b>: <?= $opData['User'] ?></h2>
		<h2><b>CodiceCentro</b>: <?= $opData['Codice_Centro'] ?></h2>
		<h2><b>Ruolo</b>: <?= $opData['Denominazione'] ?></h2>
		<h2><b>Stato</b>: <?= ($opData['Stato']) ? 'Attivo' : 'Non Attivo' ?></h2>
	<?php endif; ?>

</main>

<?php include_once($path . 'foot.php'); ?>
