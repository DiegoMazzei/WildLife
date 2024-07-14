<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>

<main>
    <?php if (isset($_GET['id'])) : ?>
        <?php if (count($terapiaData)) : ?>
            <form action="" method="post" name="myform" enctype="multipart/form-data">

                <input hidden name="codiceTerapia" value="<?= $terapiaData['Codice_Terapia'] ?>">

                <label for="diagnosi">Diagnosi</label>
                <select class="form-select" name="codiceDiagnosi" id="diagnosi">
                    <option value=""> Seleziona il codice della diagnosi </option>
                    <?php foreach ($diagnosiData as $record) : ?>
                        <?php if ($record['Codice_Diagnosi'] === $terapiaData['Codice_Diagnosi']) : ?>
                            <option selected value="<?php echo $record['Codice_Diagnosi']; ?>"><?= $record['Codice_Diagnosi'] ?></option>
                        <?php else : ?>
                            <option value="<?php echo $record['Codice_Diagnosi']; ?>"><?= $record['Codice_Diagnosi'] ?></option>
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
                <textarea value="<?= $terapiaData['Descrizione'] ?>" id="descrizione" name="descrizione" required><?= $terapiaData['Descrizione'] ?></textarea><br><br>

                <?php if ($tipologia === "Chirurgica") : ?>

                        <h1>Dati Terapia Chirurgica </h1>

                        <label for="descrizioneChirurgica">Descrizione:</label><br>
                        <textarea value="<?= $terapiaChirurgica['Descrizione'] ?>" id="descrizioneChirurgica" name="descrizioneChirurgica" required><?= $terapiaChirurgica['Descrizione'] ?></textarea><br><br>

                        <label for="noteChirurgica">Note Chirurgica:</label><br>
                        <textarea value="<?= $terapiaChirurgica['Note'] ?>" id="noteChirurgica" name="noteChirurgica" required><?= $terapiaChirurgica['Descrizione'] ?></textarea><br><br>

                        <label for="stato">Stato:</label>
                        <!--<input value="<?= $terapiaChirurgica['Stato'] ?>" min=0 max=1 type="number" id="stato" name="stato" required><br><br>-->
                        <select class="form-select" name="stato" id="stato">
                            <?php if ($terapiaChirurgica['Stato'] == '0') {
                                echo("<option selected value='0'>Non Compiuta</option>");
                                echo("<option value='1'>Compiuta</option>");
                            } else {
                                echo("<option selected value='1'>Compiuta</option>");
                                echo("<option value='0'>Non Compiuta</option>");
                            }?>
                        </select><br><br>

                        <label for="durata">Durata:</label>
                        <input value="<?= $terapiaChirurgica['Durata_Intervento'] ?>" type="time" id="durata" name="durata" required></input><br><br>

                        <label for="dataOperazione">Data Operazione:</label>
                        <input value="<?= $terapiaChirurgica['Data_Intervento'] ?>" type="date" id="dataOperazione" name="dataOperazione" required></input><br><br>

                        <label for="esito">Esito:</label><br>
                        <textarea value="<?= $terapiaChirurgica['Esito_operazione'] ?>" id="esito" name="esito" required><?= $terapiaChirurgica['Esito_operazione'] ?></textarea><br><br>

                <?php elseif ($tipologia === "Farmacologica/Medicale") : ?>
                    <?php
                    $farmaciQuery = "select distinct Codice_farmaco, MEDICINALE_VETERINARIO from farmaci";
                    $farmaciData = queryallassoc($farmaciQuery, $connection);
                    ?>

                    <h1>Dati Terapia Farmacologica</h1>

                    <label for="farmaci">Farmaci</label>
                    <select class="form-select" name="codiceFarmaco" id="farmaci">
                        <option value=""> Seleziona il farmaco </option>
                        <?php foreach ($farmaciData as $record) : ?>
                            <?php if ($record['MEDICINALE_VETERINARIO'] === $terapiaFarmacologica['MEDICINALE_VETERINARIO']) : ?>
                                <option selected value="<?php echo $record['Codice_farmaco']; ?>"><?= $record['MEDICINALE_VETERINARIO'] ?></option>
                            <?php else: ?>
                                <option value="<?php echo $record['Codice_farmaco']; ?>"><?= $record['MEDICINALE_VETERINARIO'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select><br><br>

                    <label for="posologia">Posologia:</label><br>
                    <textarea value="<?= $terapiaFarmacologica['Posologia'] ?>" id="posologia" name="posologia" required><?= $terapiaFarmacologica['Posologia'] ?></textarea><br><br>

                    <label for="frequenza">Frequenza:</label><br>
                    <input value="<?= $terapiaFarmacologica['Frequenza'] ?>" type="text" id="frequenza" name="frequenza" required></textarea><br><br>

                    <label for="durata">Durata:</label><br>
                    <input value="<?= $terapiaFarmacologica['Durata'] ?>" type="text" id="durata" name="durata" required></textarea><br><br>

                    <label for="dataInizio">Data Inizio:</label><br>
                    <input value="<?= $terapiaFarmacologica['Data_Inizio'] ?>" type="date" id="dataInizio" name="dataInizio" required></input><br><br>

                    <label for="noteFarmacologiche">Note:</label><br>
                    <textarea value="<?= $terapiaFarmacologica['Note'] ?>" id="noteFarmacologiche" name="noteFarmacologiche" required><?= $terapiaFarmacologica['Note'] ?></textarea><br><br>

                <?php elseif ($tipologia === "Riabilitativa") : ?>
                    
                    <h1>Dati Terapia Riabilitativa</h1>

                    <label for="descrizioneRiabilitativa">Descrizione:</label><br>
                    <textarea value="<?= $terapiaRiabilitativa['Descrizione'] ?>" id="descrizioneRiabilitativa" name="descrizioneRiabilitativa" required><?= $terapiaRiabilitativa['Descrizione'] ?></textarea><br><br>

                    <label for="frequenza">Frequenza:</label><br>
                    <input value="<?= $terapiaRiabilitativa['Frequenza'] ?>" type="text" id="frequenza" name="frequenza" required></textarea><br><br>

                    <label for="durata">Durata:</label><br>
                    <input value="<?= $terapiaRiabilitativa['Durata'] ?>" type="text" id="durata" name="durata" required></textarea><br><br>

                <?php endif; ?>

                <input type="submit" value="Modifica">
            </form>
        <?php else: ?>
            <h1>La terapia richiesta non esiste</h1>
        <?php endif; ?>
    <?php else: ?>
        <h1>Non hai richiesto nessuna terapia</h1>
    <?php endif; ?>
</main>

<?php include_once($path . 'foot.php'); ?>
