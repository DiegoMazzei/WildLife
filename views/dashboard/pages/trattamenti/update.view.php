<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>

<main>
    <?php if (isset($_GET['id'])) : ?>
        <?php if (count($trattamentoData)) : ?>
            <form action="" method="post" name="myform" enctype="multipart/form-data">

                <input hidden name="codiceTrattamento" value="<?= $trattamentoData['Codice_Trattamento'] ?>">

                <label for="terapia">Terapia</label>
                <select class="form-select" name="codiceTerapia" id="terapia">
                    <option value=""> Seleziona il codice della terapia </option>
                    <?php foreach ($terapiaData as $record) : ?>
                        <?php if ($record['Codice_Terapia'] === $terapiaData['Codice_Terapia']) : ?>
                            <option selected value="<?php echo $record['Cod_Terapia_Farmacologica']; ?>"><?= $record['Cod_Terapia_Farmacologica'] ?></option>
                        <?php else : ?>
                            <option value="<?php echo $record['Codice_Terapia']; ?>"><?= $record['Codice_Terapia'] ?></option>
                        <?php endif;  ?>
                    <?php endforeach; ?>
                </select><br><br>

                <label for="operatore">Operatore</label>
                <select class="form-select" name="codiceOperatore" id="operatore">
                    <?php foreach ($operatoriData as $record) : ?>
                        <?php if ($record['Codice_Utente'] === $trattamentoData['Cod_Operatore']) : ?>
                            <option selected value="<?php echo $record['Codice_Utente']; ?>"><?= $record['Nome'] ?> <?= $record['Cognome'] ?></option>
                        <?php else : ?>
                            <option value="<?php echo $record['Codice_Utente']; ?>"><?= $record['Nome'] ?> <?= $record['Cognome'] ?></option>
                        <?php endif;  ?>
                    <?php endforeach; ?>
                </select><br><br>

<label for="dataTrattamento">Data Trattamento</label><br>
<input value="<?= $dataTrattamento ?>" type="date" id="dataTrattamento" name="dataTrattamento" required></input><br><br>

<label for="note">Note:</label><br>
<textarea value="<?= $trattamentoData['Note'] ?>" id="noteTrattamento" name="noteTrattamento" required><?= $trattamentoData['Note'] ?></textarea><br><br>

                <input type="submit" value="Modifica">
            </form>
        <?php else: ?>
            <h1>Il trattamento richiesto non esiste</h1>
        <?php endif; ?>
    <?php else: ?>
        <h1>Non hai richiesto nessun trattamento</h1>
    <?php endif; ?>
</main>

<?php include_once($path . 'foot.php'); ?>