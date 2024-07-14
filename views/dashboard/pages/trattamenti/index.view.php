<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>

<main>
	<div class="tableList">
		<?php createTable($table_data, $data); ?>
	</div>

	<a href="/wildlife/controllers/dashboard/trattamenti/create.php">Aggiungi Un Trattamento</a>
</main>

<?php include_once($path . 'foot.php'); ?>