<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>

<main>
    <form action="" method="post" name="myform" enctype="multipart/form-data">

        <input hidden name="codiceDiagnosi" value="<?= $diagnosiData['Codice_Diagnosi'] ?>">

	    <!-- schede
	    epidermico
	    sensorio -->

        <label for="sensorio">Stato Sensorio</label>
        <select class="form-select" name="codiceSensorio" id="sensorio">
            <?php foreach ($sensorioData as $record) : ?>
                <?php if ($record['Codice_Stato'] === $diagnosiData['Codice_Sensorio']) : ?>
                    <option selected value="<?php echo $record['Codice_Stato']; ?>"><?= $record['Descrizione'] ?></option>
                <?php else : ?>
                    <option value="<?php echo $record['Codice_Stato']; ?>"><?= $record['Descrizione'] ?></option>
                <?php endif;  ?>
            <?php endforeach; ?>
        </select><br><br>

        <label for="epidermico">Stato Epidermico</label>
        <select class="form-select" name="codiceEpidermico" id="epidermico">
            <?php foreach ($epidermicoData as $record) : ?>
                <?php if ($record['Codice_Epidermico'] === $diagnosiData['Codice_Epidermico']) : ?>
                    <option selected value="<?php echo $record['Codice_Epidermico']; ?>"><?= $record['Descrizione'] ?></option>
                <?php else : ?>
                    <option value="<?php echo $record['Codice_Epidermico']; ?>"><?= $record['Descrizione'] ?></option>
                <?php endif;  ?>
            <?php endforeach; ?>
        </select><br><br>

        <label for="scheda">Scheda</label>
        <select class="form-select" name="codiceScheda" id="scheda">
            <?php foreach ($schedeData as $record) : ?>
                <?php if ($record['Codice_Accettazione'] === $diagnosiData['Codice_Scheda']) : ?>
                    <option selected value="<?php echo $record['Codice_Accettazione']; ?>"><?= $record['Codice_Accettazione'] ?></option>
                <?php else : ?>
                    <option value="<?php echo $record['Codice_Accettazione']; ?>"><?= $record['Codice_Accettazione'] ?></option>
                <?php endif;  ?>
            <?php endforeach; ?>
        </select><br><br>

        <label for="operatore">Operatore</label>
        <select class="form-select" name="codiceOperatore" id="operatore">
            <?php foreach ($operatoriData as $record) : ?>
                <?php if ($record['Codice_operatore'] === $diagnosiData['Codice_Operatore']) : ?>
                    <option selected value="<?php echo $record['Codice_operatore']; ?>"><?= $record['Nome'] ?> <?= $record['Cognome'] ?></option>
                <?php else : ?>
                    <option value="<?php echo $record['Codice_operatore']; ?>"><?= $record['Nome'] ?> <?= $record['Cognome'] ?></option>
                <?php endif;  ?>
            <?php endforeach; ?>
        </select><br><br>

        <label for="note">Note:</label><br>
        <textarea value="<?= $diagnosiData['Note'] ?>" id="note" name="note" required><?= $diagnosiData['Note'] ?></textarea><br><br>

        <label for="temperatura">Temperatura Corporea:</label>
        <input value="<?= $diagnosiData['Temperatura_Corporeaa'] ?>" min=30 max=60 type="number" id="temperatura" name="temperatura" required><br><br>

        <input type="submit" value="Modifica">
    </form>
</main>

<?php include_once($path . 'foot.php'); ?>
