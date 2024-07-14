<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>

<main class="schedaSoccorritore">

	<?php if (!isset($idSoccorritore)) : ?>
		<h2 class="errorTitle">Non hai richiesto alcun Soccorritore!</h1>		
	<?php elseif (count($socData) === 0) : ?>
		<h2 class="errorTitle">Il soccorritore richiesto non esiste</h1>		
	<?php else: ?>
		<h2><b>Nome</b>: <?= $socData['Nome'] ?></h2>
		<h2><b>Cognome</b>: <?= $socData['Cognome'] ?></h2>
		<h2><b>Telefono</b>: <?= $socData['Telefono'] ?></h2>
		<h2><b>Comune</b>: <?= $socData['Comune'] ?></h2>
		<h2><b>Descrizione</b>: <?= $socData['Descrizione'] ?></h2>
		<h2><b>Email</b>: <?= $socData['Email'] ?></h2>
		<br>

		<div class="salvati">
			<div class="table">
				<h2>Salvataggi Effettuati</h2>
				<?php if (count($SchedeData) !== 0) : ?>
					<?php createTable($table_data, $SchedeData); ?>
				<?php else: ?>
					<p>Non ci sono salvataggi effettuati dal soccorritore</p>	
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

</main>

<?php include_once($path . 'foot.php'); ?>
