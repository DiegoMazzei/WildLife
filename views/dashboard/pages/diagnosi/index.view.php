		<?php
		
			$title = 'Diagnosi';
			
			$path = $_SERVER['DOCUMENT_ROOT']. '/wildlife/views/dashboard/partials/';
			
			include_once ($path . 'head.php');
			
			include_once ($path . 'header.php');
			
			include_once ($path . 'sidebar.php');
			
			include_once ($path . 'foot.php');
			
		?>
		
		<main>
		
			<div class = "tableList">
		
				<?php
					
					createTable($table_data, $data);
					
				?>
				
			</div>
			
			<a href = "/wildlife/controllers/dashboard/diagnosi/create.php"> Aggiungi Una Diagnosi </a>
			
		</main>
	
	</body>
</html>
