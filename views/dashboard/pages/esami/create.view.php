<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>

<script>

    function controllo() {

        let diagnosi = document.forms["myform"]["diagnosi"].value;

        let esame = document.forms["myform"]["esame"].value;

        let operatore = document.forms["myform"]["operatore"].value;

        if (diagnosi == "") {

            window.alert("Inserisci il codice della diagnosi");

            return false;

        }

        if (esame == "") {

            window.alert("Inserisci la tipologia dell'esame");

            return false;

        }

        if (operatore == "") {

            window.alert("Inserisci l'operatore");

            return false;

        }

    }

</script>

<main>
    <form action="" method="post" name="myform" enctype="multipart/form-data" onsubmit = "return controllo()">

        <!-- 
	$codiceDiagnosi = $_POST["codiceDiagnosi"];
	$codiceEsame = $_POST["codiceEsame"];
	$descrizione = $_POST["descrizione"];
	$codiceOperatore = $_POST["codiceOperatore"];
	$stato = $_POST["stato"];
	$sintesiEsito = $_POST["sintesiEsito"];
-->
        <label for="diagnosi">Diagnosi</label>
        <select class="form-select" name="codiceDiagnosi" id="diagnosi">
            <option value=""> Seleziona il codice della diagnosi </option>
            <?php foreach ($diagnosiData as $record) : ?>
                <option value="<?php echo $record['Codice_Diagnosi']; ?>"><?= $record['Codice_Diagnosi'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="esame">Esame</label>
        <select class="form-select" name="codiceEsame" id="esame">
            <option value=""> Seleziona il Tipo d'Esame </option>
            <?php foreach ($esamiData as $record) : ?>
                <option value="<?php echo $record['Codice_Esame']; ?>"><?= $record['Tipologia'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="operatore">Operatore</label>
        <select class="form-select" name="codiceOperatore" id="operatore">
            <option value=""> Seleziona il Nome dell'Operatore </option>
            <?php foreach ($operatoriData as $record) : ?>
                <option value="<?php echo $record['Codice_operatore']; ?>"><?= $record['Nome'] ?> <?= $record['Cognome'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="descrizione">Descrizione:</label><br>
        <textarea id="descrizione" name="descrizione" required></textarea><br><br>

        <label for="sintesi">Sintesi esito:</label><br>
        <textarea id="sintesi" name="sintesiEsito" required></textarea><br><br>

        <label for="stato">Stato:</label>
        <!--<input min=0 max=1 type="number" id="stato" name="stato" required><br><br>-->
        <select class='form-select' name='stato' id='stato'>
        		    <option value="">Seleziona lo Stato dell'Esame</option>
        		    <option value="1">Compiuto</option>
        		    <option value="0">Non Compiuto</option>
        		</select><br><br>

        <!-- <label for="immagine">Immagine Animale: </label> <br>
        <input type="file" name="immagine" id="immagine"> <br><br> -->

        <input type="submit" value="Invia">
        <button type = "reset"> Reset </button>
    </form>
</main>

<?php include_once($path . 'foot.php'); ?>
