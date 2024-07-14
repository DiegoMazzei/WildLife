<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>

<main>
    <form action="" method="post" name="myform" enctype="multipart/form-data">

        <!-- 
	$codiceDiagnosi = $_POST["codiceDiagnosi"];
	$codiceEsame = $_POST["codiceEsame"];
	$descrizione = $_POST["descrizione"];
	$codiceOperatore = $_POST["codiceOperatore"];
	$stato = $_POST["stato"];
	$sintesiEsito = $_POST["sintesiEsito"];
-->
        <input hidden name="codicePrescrizione" value="<?= $esameData['Codice_prescrizione'] ?>">
        <input hidden name="timestamp" value="<?= $esameData['Data_Referto'] ?>">

        <label for="diagnosi">Diagnosi</label>
        <select class="form-select" name="codiceDiagnosi" id="diagnosi">
            <option value=""> Seleziona il codice della diagnosi </option>
            <?php foreach ($diagnosiData as $record) : ?>
                <?php if ($record['Codice_Diagnosi'] === $esameData['Codice_Diagnosi']) : ?>
                    <option selected value="<?php echo $record['Codice_Diagnosi']; ?>"><?= $record['Codice_Diagnosi'] ?></option>
                <?php else : ?>
                    <option value="<?php echo $record['Codice_Diagnosi']; ?>"><?= $record['Codice_Diagnosi'] ?></option>
                <?php endif;  ?>
            <?php endforeach; ?>
        </select><br><br>

        <label for="esame">Esame</label>
        <select class="form-select" name="codiceEsame" id="esame">
            <option value=""> Seleziona il codice dell'esame </option>
            <?php foreach ($esamiData as $record) : ?>
                <?php if ($record['Codice_Esame'] === $esameData['Codice_Esame']) : ?>
                    <option selected value="<?php echo $record['Codice_Esame']; ?>"><?= $record['Tipologia'] ?></option>
                <?php else : ?>
                    <option value="<?php echo $record['Codice_Esame']; ?>"><?= $record['Tipologia'] ?></option>
                <?php endif;  ?>
            <?php endforeach; ?>
        </select><br><br>

        <label for="operatore">Operatore</label>
        <select class="form-select" name="codiceOperatore" id="operatore">
            <option value=""> Seleziona il codice del operatore di operatore </option>
            <?php foreach ($operatoriData as $record) : ?>
                <?php if ($record['Codice_Operatore'] === $operatoreData['Codice_Operatore']) : ?>
                    <option selected value="<?php echo $record['Codice_operatore']; ?>"><?= $record['Nome'] ?> <?= $record['Cognome'] ?></option>
                <?php else : ?>
                    <option value="<?php echo $record['Codice_operatore']; ?>"><?= $record['Nome'] ?> <?= $record['Cognome'] ?></option>
                <?php endif;  ?>
            <?php endforeach; ?>
        </select><br><br>

        <label for="descrizione">Descrizione:</label><br>
        <textarea value="<?= $esameData['Descrizione'] ?>" id="descrizione" name="descrizione" required><?= $esameData['Descrizione'] ?></textarea><br><br>

        <label for="sintesi">Sintesi esito:</label><br>
        <textarea value="<?= $esameData['Sintesi_Esito'] ?>" id="sintesi" name="sintesiEsito" required><?= $esameData['Sintesi_Esito'] ?></textarea><br><br>

        <label for="stato">Stato:</label>
        <!--<input value="<?= $esameData['Stato'] ?>" min=0 max=1 type="number" id="stato" name="stato" required><br><br>-->
        <select class="form-select" name="stato" id="stato">
            <?php if ($esameData['Stato'] == '0') {
                echo("<option selected value='0'>Non Compiuto</option>");
                echo("<option value='1'>Compiuto</option>");
            } else {
                echo("<option selected value='1'>Compiuto</option>");
                echo("<option value='0'>Non Compiuto</option>");
            }?>
        </select><br><br>

        <!-- <label for="immagine">Immagine Animale: </label> <br>
        <input type="file" name="immagine" id="immagine"> <br><br> -->

        <input type="submit" value="Modifica">
    </form>
</main>

<?php include_once($path . 'foot.php'); ?>
