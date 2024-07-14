<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php require 'permit.php';?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>


<main>

	<h1>Gestione utenti</h1><br>
	
	<div class="tableList">
	
		<?php createTable($table_data, $data); ?>
	
	</div>

	<a href="/wildlife/controllers/dashboard/utenti/create.php">Aggiungi un Utente</a>

</main>

<?php include_once($path . 'foot.php'); ?>
