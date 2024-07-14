<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>

<main class="schedaVeterinario">

	<?php if (!isset($idScheda)) : ?>
		<h2 class="errorTitle">Non hai richiesto alcun veterinario!</h1>		
	<?php elseif (count($schedaData) === 0) : ?>
		<h2 class="errorTitle">Il veterinario richiesto non esiste</img>		
	<?php else: ?>
		<h2><b>Data Arrivo</b>: <?= $schedaData['Data_arrivo'] ?></h2>
		<h2><b>Tipologia Animale</b>: <?= $schedaData['Animale'] ?></h2>
		<h2><b>Longitudine Ritrovamento</b>: <?= $schedaData['Longitudine'] ?></h2>
		<h2><b>Latitudine Ritrovamento</b>: <?= $schedaData['Latitudine'] ?></h2>
		<h2><b>Comune Ritrovamento</b>: <?= $schedaData['Comune'] ?></h2>
		<h2><b>Centro</b>: <?= $schedaData['Centro'] ?></h2>
		<h2><b>Fase Sviluppo Animale</b>: <?= $schedaData['Fase_sviluppo'] ?></h2>
		<h2><b>Tipologia Ricovero</b>: <?= $schedaData['Ricovero'] ?></h2>
		<h2><b>Tipologia Triage</b>: <?= $schedaData['Triage'] ?></h2>
		<h2><b>Esito</b>:
		<?php if(isset($schedaData['Esito'])) {
		    echo($schedaData['Esito']);
		} else {
		    echo('Scheda ancora aperta');
		}?></h2>

		<h2><b>Data Esito</b>:
		<?php if (isset($schedaData['Data_Esito_Finale'])) {
		    echo($schedaData['Data_Esito_Finale']);
		} else {
		    echo('X');
		}?></h2>
		<h2><b>Foto dell'Animale:</b><br><br>

		<img src="/wildlife/uploads/schede/<?= $imageTimestamp ?>.<?= $imageFiletype ?>">

		<br><br><br>
		<h2><b>Salvato da:</b> <?= $schedaData['Soccorritore'] ?></h2>
		<h2><b>Registrato da</b>: <?= $schedaData['Operatore'] ?></h2>

		<br>
	<?php endif; ?>

</main>

<?php include_once($path . 'foot.php'); ?>
