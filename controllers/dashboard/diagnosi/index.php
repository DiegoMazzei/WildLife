        <?php

            $root = $_SERVER['DOCUMENT_ROOT']. '/wildlife/';
            require ($root . 'functions/table.php');
            require ($root . 'database.php');
			
			

            $query = 'SELECT Codice_Diagnosi, Codice_Scheda, STE.Descrizione, STS.Descrizione, Temperatura_Corporeaa, Codice_Operatore, Note, Codice_Diagnosi, Codice_Diagnosi
           			  FROM (diagnosi AS d JOIN stato_epidermico AS STE ON d.Codice_Epidermico = STE.codice_epidermico) JOIN stato_sensorio AS STS ON d.Codice_Sensorio = STS.Codice_stato
					  ORDER BY Codice_Diagnosi ASC';

            $result = $connection -> query($query);

            if ($result) {

                $data = $result -> fetch_all();

                $table_data = [

                    //sono array di indice numerico
                    "columns" => [     'Diagnosi', 'Scheda', 'Stato Epidermico', 'Stato Sensorio', 'Temperatura Corporea', 'Operatore', 'Note', 'Modifica', 'Elimina'],
                    
                    "columns_type" => ['diagnosi_link',   'scheda_link',   'text',              'text',            'text',                   'vet_link',       'text', 'diagnosi_edit', 'diagnosi_delete'],
                
				];

            }

            else {

                die ('Errore, query non eseguita correttamente');

            }
			
			include_once ($root . 'views/dashboard/pages/diagnosi/index.view.php');

        ?>

    </body>

</html>
