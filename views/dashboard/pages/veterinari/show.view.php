<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>

<main class="schedaVeterinario">

	<?php if (!isset($idVeterinario)) : ?>
		<h2 class="errorTitle">Non hai richiesto alcun veterinario!</h1>		
	<?php elseif (count($vetData) === 0) : // Veterinario richiesto non esiste nel DB ?>
		<h2 class="errorTitle">Il veterinario richiesto non esiste</h1>		
	<?php else: ?>
		<h2><b>Nome</b>: <?= $vetData['Nome'] ?></h2>
		<h2><b>Cognome</b>: <?= $vetData['Cognome'] ?></h2>
		<h2><b>Telefono</b>: <?= $vetData['Telefono'] ?></h2>
		<h2><b>Comune</b>: <?= $vetData['Comune'] ?></h2>
		<h2><b>Centro</b>: <?= $vetData['Centro'] ?></h2>

		<br>
		<br>

		<div class="diagnosi">
			<div class="table">
				<h2>Diagnosi Effettuate</h2>
				<?php if (count($diagnosiData) !== 0) : ?>
					<?php createTable($diagnosiFormat, $diagnosiData); ?>
				<?php else: ?>
					<p>Non ci sono diagnosi a carico del veterinario</p>	
				<?php endif; ?>
			</div>
		</div>

		<br>
		<br>
		<div class="terapie">
			<div class="table">
				<h2>Terapie Effettuate</h2>
				<?php if (count($terapieData) !== 0) : ?>
					<?php createTable($terapieFormat, $terapieData); ?>
				<?php else: ?>
				<p>Non ci sono terapie a carico del veterinario</p>	
				<?php endif; ?>
			</div>
		</div>

		<br>
		<br>
		<div class="trattamenti">
			<div class="table">
				<h2>Trattamenti Effettuati</h2>
				<?php if (count($trattamentiData) !== 0) : ?>
					<?php createTable($trattamentiFormat, $trattamentiData); ?>
				<?php else: ?>
					<p>Non ci sono trattamenti a carico del veterinario</p>	
				<?php endif; ?>
			</div>
		</div>

		<br>
		<br>
		<div class="esami">
			<div class="table">
				<h2>Esami Effettuati</h2>
				<?php if (count($esamiData) !== 0) : ?>
					<?php createTable($esamiFormat, $esamiData); ?>
				<?php else: ?>
					<p>Non ci sono esami a carico del veterinario</p>	
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

</main>

<?php include_once($path . 'foot.php'); ?>
