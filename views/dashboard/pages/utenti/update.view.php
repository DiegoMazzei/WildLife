<?php 
$path = $root . '/views/dashboard/partials/';
include_once($path . 'head.php');
require 'permit.php';
include_once($path . 'sidebar.php');
include_once($path . 'header.php');


require($root . 'database.php');

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = htmlspecialchars($_GET['id']);

    $query = $connection->query("SELECT utenti.*, regprovcomune.Comune FROM utenti JOIN regprovcomune ON regprovcomune.Codice_comune = utenti.Codice_comune WHERE Codice_Utente = $id");

    if ($query->num_rows === 1) {
        $row = $query->fetch_assoc(); 
?>

<main>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>

    let responseFile = "/wildlife/controllers/dashboard/regprovcomune.php";
    $(document).ready(function() {
        $('#regione').on('change', function() {
            let regione = $(this).val();
        $.ajax({
                method: "POST",
                url: responseFile,
                data: {
                    regione: regione
                },
                datatype: "html",
                success: function (data) {
                    $("#provincia").html(data);
                    $("#comune").html("<option value=''>Seleziona Comune</option>")
                }
            })
        });
    });

    $(document).ready(function() {
        $('#provincia').on('change', function() {
            let provincia = $(this).val();
        $.ajax({
                method: "POST",
                url: responseFile,
                data: {
                    provincia: provincia
                },
                datatype: "html",
                success: function (data) {
                    $("#comune").html(data);
                }
            })
        });
    });
    </script>

    <form action='update.php' method='post' name='myform'>
        <input type='hidden' name='id' value='<?php echo $row['Codice_Utente']; ?>'><br>
        <label for="Nome">Nome:</label><br>
        <input type='text' name='nome' value='<?php echo $row['Nome']; ?>'><br>
        <label for="Cognome">Cognome:</label><br>
        <input type='text' name='cognome' value='<?php echo $row['Cognome']; ?>'><br>
        <label for="Indirizzo">Indirizzo:</label><br>
        <input type='text' name='indirizzo' value='<?php echo $row['Indirizzo']; ?>'><br>
        
        <label for="regione"> Regione</label>
        <select class="form-select" id="regione">
            <option  value=""> Seleziona la Regione dell'Utente</option>
            <?php foreach ($regioniData as $record) : ?>
                <option value="<?php echo $record['Regione']; ?>"> <?= $record['Regione'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="provincia"> Provincia</label>
        <select class="form-select" id="provincia">
        </select><br><br>

        <label for="comune"> Comune</label>
        <select class="form-select" name="codiceComune" id="comune">
        </select><br><br>

        <label for="Telefono">Telefono:</label><br>
        <input type='text' name='telefono' value='<?php echo $row['Telefono']; ?>'><br>

        <label for="Email">Email:</label><br>
        <input type='text' name='email' value='<?php echo $row['Email']; ?>'><br>

        <label for="Username">Username:</label><br>
        <input type='text' name='username' value='<?php echo $row['User']; ?>'><br>

        <label for="Password">Password:</label><br>
        <input type='password' name='password' value=''><br>
            


            <label for="codiceRuolo"> Ruolo</label>
        <select class="form-select" name="codiceRuolo" id="codiceRuolo">
        <?php
            $query_ruolo = "SELECT DISTINCT Codice_Ruolo, Denominazione FROM tipologia_ruolo ORDER BY Denominazione ASC;";
            $result_ruolo = $connection->query($query_ruolo);
            if ($result_ruolo->num_rows > 0) {
                while ($row_ruolo = mysqli_fetch_assoc($result_ruolo)){ 
             $selected = ($row['Codice_Comune'] == $row_comune['Codice_Comune']) ? 'selected' : '';
            ?>
        <option name="codiceCentro" value="<?php echo $row_ruolo['Codice_Ruolo']; ?>" <?php echo $selected; ?>><?php echo $row_ruolo['Denominazione']; ?></option>
        <?php
            }
        }            
        ?>
</select><br><br>

<label for="Codice_Centro"> Centro</label>
        <select class="form-select" name="codiceCentro" id="codiceCentro">
        <?php
            $query_centro = "SELECT DISTINCT Codice_Centro, Denominazione FROM anagrafica_centro ORDER BY Denominazione ASC;";
            $result_centro = $connection->query($query_centro);
            if ($result_centro->num_rows > 0) {
                while ($row_centro = mysqli_fetch_assoc($result_centro)){ 
            $selected = ($row['Codice_Centro'] == $row_centro['Codice_Centro']) ? 'selected' : '';
            ?>
        <option name="codiceCentro" value="<?php echo $row_centro['Codice_Centro']; ?>" <?php echo $selected; ?>><?php echo $row_centro['Denominazione']; ?></option>
        <?php
            }
        }            
        ?>
</select><br><br>




        

        <input type='submit' value='Modifica'>
    </form>
</main>

<?php
    } else {
        echo "Il soccorritore non esiste nei nostri archivi";
        die();
    }
}
?>


